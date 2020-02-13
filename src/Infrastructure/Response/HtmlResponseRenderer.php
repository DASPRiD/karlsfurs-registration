<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Response;

use DASPRiD\Helios\IdentityMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

final class HtmlResponseRenderer implements ResponseRendererInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function render(string $name, ServerRequestInterface $request, array $params = []) : ResponseInterface
    {
        $identity = $request->getAttribute(IdentityMiddleware::IDENTITY_ATTRIBUTE);
        $params['emailAddress'] = $identity['emailAddress'] ?? null;
        $params['displayName'] = $identity['displayName'] ?? null;
        $params['locale'] = $request->getAttribute('locale');

        return new HtmlResponse($this->templateRenderer->render(
            $name,
            $params
        ));
    }
}
