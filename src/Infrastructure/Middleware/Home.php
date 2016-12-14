<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use DASPRiD\Helios\IdentityMiddleware;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Attendee\Attendee;
use Suitwalk\Domain\Attendee\ReplaceAttendeesInterface;
use Suitwalk\Domain\Attendee\SearchAttendeesByEmailAddressInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Infrastructure\Form\AttendeeData;
use Suitwalk\Infrastructure\Form\AttendeeFormBuilder;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;
use Suitwalk\Infrastructure\Response\ResponseRendererInterface;
use Zend\Diactoros\Response\RedirectResponse;

final class Home
{
    /**
     * @var SuitwalkOptions
     */
    private $suitwalkOptions;

    /**
     * @var GetAllGroupsInterface
     */
    private $getAllGroup;

    /**
     * @var SearchAttendeesByEmailAddressInterface
     */
    private $searchAttendeesByEmailAddress;

    /**
     * @var ReplaceAttendeesInterface
     */
    private $replaceAttendees;

    /**
     * @var AttendeeFormBuilder
     */
    private $formBuilder;

    /**
     * @var ResponseRendererInterface
     */
    private $responseRenderer;

    public function __construct(
        SuitwalkOptions $suitwalkOptions,
        GetAllGroupsInterface $getAllGroup,
        SearchAttendeesByEmailAddressInterface $searchAttendeesByEmailAddress,
        ReplaceAttendeesInterface $replaceAttendees,
        AttendeeFormBuilder $formBuilder,
        ResponseRendererInterface $responseRenderer
    ) {
        $this->suitwalkOptions = $suitwalkOptions;
        $this->getAllGroup = $getAllGroup;
        $this->searchAttendeesByEmailAddress = $searchAttendeesByEmailAddress;
        $this->replaceAttendees = $replaceAttendees;
        $this->formBuilder = $formBuilder;
        $this->responseRenderer = $responseRenderer;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $groups = $this->getAllGroup->getAll();
        $registrationClosed = (new DateTimeImmutable() > $this->suitwalkOptions->getNextDate());
        $emailAddress = $request->getAttribute(IdentityMiddleware::IDENTITY_ATTRIBUTE);

        if (null === $emailAddress || $registrationClosed) {
            return $this->responseRenderer->render('common::home', $request, [
                'form' => null,
                'groups' => $groups,
                'registrationClosed' => $registrationClosed,
            ]);
        }

        $form = $this->formBuilder->buildForm($emailAddress, $groups);
        $existingAttendees = $this->searchAttendeesByEmailAddress->searchByEmailAddress($emailAddress);

        if ('POST' === $request->getMethod()) {
            $form = $form->bindFromRequest($request);

            if (!$form->hasErrors()) {
                $this->replaceAttendees->replaceAttendees($existingAttendees, $form->getValue()->getAttendees());
                return new RedirectResponse($request->getUri());
            }
        } elseif (0 === count($existingAttendees)) {
            $form = $form->fill(new AttendeeData([
                new Attendee('', $groups[0], '', Attendee::STATUS_NO, Attendee::STATUS_NO)
            ]));
        } else {
            $form = $form->fill(new AttendeeData($existingAttendees));
        }

        return $this->responseRenderer->render('common::home', $request, [
            'form' => $form,
            'groups' => $groups,
            'registrationClosed' => false,
        ]);
    }
}
