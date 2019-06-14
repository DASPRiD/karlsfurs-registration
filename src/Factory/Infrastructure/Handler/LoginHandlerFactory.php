<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\LoginHandler;
use Suitwalk\Infrastructure\Response\HtmlResponseRenderer;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;

final class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $loginConfig = $container->get('config')['login'];
        $signerClass = $loginConfig['signer'];

        return new LoginHandler(
            new $signerClass,
            $loginConfig['signature_key'],
            $loginConfig['verification_key'],
            $container->get(UrlHelper::class),
            $container->get(IdentityCookieManager::class),
            $container->get(TemplateRendererInterface::class),
            $container->get(HtmlResponseRenderer::class)
        );
    }
}
