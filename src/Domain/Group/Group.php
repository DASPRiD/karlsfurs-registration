<?php
declare(strict_types = 1);

namespace Suitwalk\Domain\Group;

final class Group
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameDe;

    private function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName(string $languageCode) : string
    {
        return 'de' === $languageCode ? $this->nameDe : $this->nameEn;
    }
}
