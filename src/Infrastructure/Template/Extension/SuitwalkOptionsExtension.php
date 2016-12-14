<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Template\Extension;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Suitwalk\Infrastructure\Options\SuitwalkOptions;

final class SuitwalkOptionsExtension implements ExtensionInterface
{
    /**
     * @var SuitwalkOptions
     */
    private $suitwalkOptions;

    public function __construct(SuitwalkOptions $suitwalkOptions)
    {
        $this->suitwalkOptions = $suitwalkOptions;
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('getSuitwalkOptions', [$this, 'getSuitwalkOptions']);
    }

    public function getSuitwalkOptions() : SuitwalkOptions
    {
        return $this->suitwalkOptions;
    }
}
