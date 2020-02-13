<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\TelegramSigninHandler;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;
use Zend\Expressive\Helper\UrlHelper;

final class TelegramSigninHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $suitwalkOptions = $container->get(SuitwalkOptions::class);
        assert($suitwalkOptions instanceof SuitwalkOptions);

        return new TelegramSigninHandler(
            $suitwalkOptions->getTelegramBotToken(),
            $container->get(UrlHelper::class),
            $container->get(IdentityCookieManager::class)
        );
    }
}
