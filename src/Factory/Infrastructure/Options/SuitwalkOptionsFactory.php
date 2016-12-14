<?php
namespace Suitwalk\Factory\Infrastructure\Options;

use DateTimeImmutable;
use Interop\Container\ContainerInterface;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;

final class SuitwalkOptionsFactory
{
    public function __invoke(ContainerInterface $container) : SuitwalkOptions
    {
        $config = $container->get('config')['suitwalk'];

        return new SuitwalkOptions(
            DateTimeImmutable::createFromFormat('!Y-m-d', $config['next_date'] ?? ''),
            DateTimeImmutable::createFromFormat('!H:i', $config['meeting_time'] ?? ''),
            DateTimeImmutable::createFromFormat('!H:i', $config['departure_time'] ?? ''),
            DateTimeImmutable::createFromFormat('!H:i', $config['return_time'] ?? ''),
            DateTimeImmutable::createFromFormat('!H:i', $config['dinner_time'] ?? ''),
            $config['meeting_point_address'] ?? '',
            $config['meeting_point_embed_url'] ?? '',
            $config['meeting_point_additional_information'] ?? ['de' => '', 'en' => ''],
            $config['restaurant_address'] ?? '',
            $config['restaurant_embed_url'] ?? '',
            $config['furbase_thread_url'] ?? '',
            $config['telegram_group_url'] ?? ''
        );
    }
}
