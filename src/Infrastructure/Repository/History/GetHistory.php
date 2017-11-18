<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Repository\History;

use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Suitwalk\Domain\Group\Group;
use Suitwalk\Domain\History\GetHistoryInterface;
use Suitwalk\Domain\History\HistoryCount;
use Suitwalk\Domain\History\HistoryEvent;

final class GetHistory implements GetHistoryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Group[] $groups
     */
    public function __invoke(array $groups) : array
    {
        $select = ['event.date AS date'];

        foreach ($groups as $group) {
            $select[] = '(
                SELECT COUNT(*) FROM attendee
                WHERE attendee.eventId = event.id AND attendee.groupId = ' . $group->getId() . '            
            ) AS group' . $group->getId();
        }

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select($select);
        $queryBuilder->from('event');
        $queryBuilder->orderBy('event.date', 'asc');

        $rows = $queryBuilder->execute()->fetchAll();
        $result = [];

        foreach ($rows as $row) {
            $counts = [];

            foreach ($groups as $group) {
                $counts[] = new HistoryCount($group, (int) $row['group' . $group->getId()]);
            }

            $result[] = new HistoryEvent(new DateTimeImmutable($row['date']), $counts);
        }

        return $result;
    }
}
