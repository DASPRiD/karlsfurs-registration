<?php
namespace Suitwalk\Factory\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Google_Client;
use Interop\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\TokenSigninHandler;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;

final class TokenSigninHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $suitwalkOptions = $container->get(SuitwalkOptions::class);
        assert($suitwalkOptions instanceof SuitwalkOptions);

        return new TokenSigninHandler(
            new Google_Client(['client_id' => $suitwalkOptions->getOauthClientId()]),
            $container->get(IdentityCookieManager::class)
        );
    }
}
