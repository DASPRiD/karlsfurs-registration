<?php
namespace Suitwalk\Factory\Infrastructure\Options;

use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;

final class SuitwalkOptionsFactory
{
    public function __invoke(ContainerInterface $container) : SuitwalkOptions
    {
        $config = $container->get('config')['suitwalk'];

        return new SuitwalkOptions(
            $config['telegram_bot_name'] ?? '',
            $config['telegram_bot_token'] ?? '',
            $config['oauth_client_id'] ?? '',
            $config['maps_api_key'] ?? '',
            $config['furbase_thread_url'] ?? '',
            $config['telegram_group_url'] ?? ''
        );
    }
}
