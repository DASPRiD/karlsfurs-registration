<?php
namespace Suitwalk\Factory\Infrastructure\Repository\History;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\History\GetHistoryInterface;
use Suitwalk\Infrastructure\Repository\History\GetHistory;

final class GetHistoryFactory
{
    public function __invoke(ContainerInterface $container) : GetHistoryInterface
    {
        return new GetHistory(
            $container->get(EntityManagerInterface::class)->getConnection()
        );
    }
}
