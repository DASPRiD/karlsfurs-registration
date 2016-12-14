<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;
use Zend\Expressive\Template\TemplateRendererInterface;

final class Svg
{
    /**
     * @var GetAllGroupsInterface
     */
    private $getAllGroup;

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    public function __construct(GetAllGroupsInterface $getAllGroup, TemplateRendererInterface $templateRenderer)
    {
        $this->getAllGroup = $getAllGroup;
        $this->templateRenderer = $templateRenderer;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($this->templateRenderer->render('common::svg', [
            'locale' => $request->getAttribute('locale'),
            'groups' => $this->getAllGroup->getAll(),
        ]));
        $body->rewind();

        return new Response($body, 200, ['Content-Type' => 'image/svg+xml']);
    }
}
