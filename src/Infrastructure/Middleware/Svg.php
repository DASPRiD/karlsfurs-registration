<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Event\GetLatestEventInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;
use Zend\Expressive\Template\TemplateRendererInterface;

final class Svg
{
    /**
     * @var GetLatestEventInterface
     */
    private $getLatestEvent;

    /**
     * @var GetAllGroupsInterface
     */
    private $getAllGroup;

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    public function __construct(
        GetLatestEventInterface $getLatestEvent,
        GetAllGroupsInterface $getAllGroup,
        TemplateRendererInterface $templateRenderer
    ) {
        $this->getLatestEvent = $getLatestEvent;
        $this->getAllGroup = $getAllGroup;
        $this->templateRenderer = $templateRenderer;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($this->templateRenderer->render('common::svg', [
            'locale' => $request->getAttribute('locale'),
            'event' => $this->getLatestEvent->__invoke(),
            'groups' => $this->getAllGroup->__invoke(),
        ]));
        $body->rewind();

        return new Response($body, 200, ['Content-Type' => 'image/svg+xml']);
    }
}
