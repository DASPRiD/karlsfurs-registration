<?php
namespace Suitwalk\Factory\Infrastructure\Response;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;
use Zend\Expressive\Template\TemplateRendererInterface;

final class HtmlResponseRendererFactory
{
    public function __invoke(ContainerInterface $container) : HtmlResponseRenderer
    {
        return new HtmlResponseRenderer(
            $container->get(TemplateRendererInterface::class)
        );
    }
}
