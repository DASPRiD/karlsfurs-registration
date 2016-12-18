<?php
namespace Suitwalk\Factory\Infrastructure\Repository\Medium;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Suitwalk\Domain\Medium\Medium;
use Suitwalk\Infrastructure\Repository\Medium\GetAllMedia;

final class GetAllMediaFactory
{
    public function __invoke(ContainerInterface $container) : GetAllMedia
    {
        return new GetAllMedia(
            $container->get(EntityManagerInterface::class)->getRepository(Medium::class)
        );
    }
}
