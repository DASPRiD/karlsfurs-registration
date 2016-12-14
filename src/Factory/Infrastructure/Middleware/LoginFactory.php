<?php
namespace Suitwalk\Factory\Infrastructure\Middleware;

use DASPRiD\Helios\CookieManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Middleware\Login;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;

final class LoginFactory
{
    public function __invoke(ContainerInterface $container) : Login
    {
        $loginConfig = $container->get('config')['login'];
        $signerClass = $loginConfig['signer'];

        return new Login(
            new $signerClass,
            $loginConfig['signature_key'],
            $loginConfig['verification_key'],
            $container->get(UrlHelper::class),
            $container->get(CookieManagerInterface::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
