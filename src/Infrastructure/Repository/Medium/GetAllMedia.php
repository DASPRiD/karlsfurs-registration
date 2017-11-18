<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Medium;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Medium\GetAllMediaInterface;

final class GetAllMedia implements GetAllMediaInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke() : array
    {
        return $this->repository->findBy([], ['type' => 'asc', 'name' => 'asc']);
    }
}
