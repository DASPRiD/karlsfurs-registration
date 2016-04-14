<?php
namespace App\Action;

use App\Helper\LoginHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $loginConfig = $container->get('config')['login'];
        $signerClass = $loginConfig['signer'];

        return new LoginAction(
            $container->get(TemplateRendererInterface::class),
            new $signerClass(),
            $loginConfig['signatureKey'],
            $loginConfig['verificationKey'],
            $container->get(LoginHelper::class),
            $container->get(UrlHelper::class)
        );
    }
}
