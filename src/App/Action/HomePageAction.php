<?php
namespace App\Action;

use App\Entity\Attendee;
use App\Entity\Group;
use App\Helper\LoginHelper;
use App\Repository\AttendeeRepository;
use App\Repository\GroupRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Filter\StringTrim;
use Zend\Form\Form;
use Zend\Hydrator\Reflection;
use Zend\Stdlib\Hydrator\Strategy\ClosureStrategy;
use Zend\Validator\StringLength;

class HomePageAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * @var AttendeeRepository
     */
    private $attendeeRepository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var LoginHelper
     */
    private $loginHelper;

    public function __construct(
        TemplateRendererInterface $template,
        GroupRepository $groupRepository,
        AttendeeRepository $attendeeRepository,
        ObjectManager $objectManager,
        LoginHelper $loginHelper
    ) {
        $this->template = $template;
        $this->groupRepository = $groupRepository;
        $this->attendeeRepository = $attendeeRepository;
        $this->objectManager = $objectManager;
        $this->loginHelper = $loginHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $groups = $this->groupRepository->findAll();
        $form = $this->getForm($groups);

        if ('POST' === $request->getMethod()) {
            $form->setData($request->getParsedBody());

            if ($form->isValid()) {
                $attendee = $form->getData();
                $attendee->updateLastUpdateDateTime();
                $this->objectManager->persist($attendee);
                $this->objectManager->flush();
                return new RedirectResponse($request->getUri());
            }
        }

        return new HtmlResponse($this->template->render('app::home-page', [
            'form' => $form,
            'groups' => $groups,
        ]));
    }

    /**
     * @param Group[] $groups
     * @return Form|null
     */
    private function getForm($groups)
    {
        if (null === $this->loginHelper->getEmailAddress()) {
            return null;
        }

        $groupOptions = [];

        foreach ($groups as $group) {
            $groupOptions[$group->getId()] = $group->getName();
        }

        $form = new Form();
        $form->setHydrator($this->getHydrator());
        $form->add([
            'name' => 'name',
            'options' => ['label' => 'Name'],
            'attributes' => ['class' => 'form-control', 'required' => 'required', 'maxlength' => 32],
            'type' => 'text',
        ]);
        $form->add([
            'name' => 'group',
            'options' => [
                'label' => 'Gruppe',
                'value_options' => $groupOptions,
            ],
            'attributes' => ['class' => 'form-control', 'required' => 'required'],
            'type' => 'select',
        ]);
        $form->add([
            'name' => 'walkStatus',
            'options' => [
                'label' => 'Walk',
                'value_options' => [
                    Attendee::STATUS_YES => 'ja',
                    Attendee::STATUS_NO => 'nein',
                    Attendee::STATUS_MAYBE => 'vielleicht',
                ],
            ],
            'attributes' => ['class' => 'form-control', 'required' => 'required'],
            'type' => 'select',
        ]);
        $form->add([
            'name' => 'dinnerStatus',
            'options' => [
                'label' => 'Essen',
                'value_options' => [
                    Attendee::STATUS_YES => 'ja',
                    Attendee::STATUS_NO => 'nein',
                    Attendee::STATUS_MAYBE => 'vielleicht',
                ],
            ],
            'attributes' => ['class' => 'form-control', 'required' => 'required'],
            'type' => 'select',
        ]);

        $form->getInputFilter()->get('name')->setRequired(true);
        $form->getInputFilter()->get('name')->getFilterChain()->attach(new StringTrim());
        $form->getInputFilter()->get('name')->getValidatorChain()->attach(new StringLength(1, 32));

        $attendee = $this->attendeeRepository->findOneByEmailAddress($this->loginHelper->getEmailAddress());

        if (null !== $attendee) {
            $form->bind($attendee);
        } else {
            $form->bind(new Attendee($this->loginHelper->getEmailAddress()));
        }

        return $form;
    }

    /**
     * @return Reflection
     */
    private function getHydrator()
    {
        $hydrator = new Reflection();
        $hydrator->addStrategy('group', new ClosureStrategy(function (Group $group = null) {
            return null === $group ? null : $group->getId();
        }, function ($groupId) {
            return $this->groupRepository->findOneById($groupId);
        }));

        return $hydrator;
    }
}
