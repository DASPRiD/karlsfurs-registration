<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\Event;

use Doctrine\Common\Persistence\ObjectRepository;
use Suitwalk\Domain\Event\Event;
use Suitwalk\Domain\Event\GetLatestEventInterface;

final class GetLatestEvent implements GetLatestEventInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke() : Event
    {
        return $this->repository->findOneBy([], ['date' => 'desc']);
    }
}
