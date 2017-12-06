<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Event;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Event\GetAllEventsInterface;

final class GetAllEvents implements GetAllEventsInterface
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
        return $this->repository->findAll();
    }
}
