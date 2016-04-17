<?php
namespace App\Helper;

use App\Options\SuitwalkOptions;
use Zend\View\Helper\AbstractHelper;

class SuitwalkOptionsHelper extends AbstractHelper
{
    /**
     * @var SuitwalkOptions
     */
    private $suitwalkOptions;

    /**
     * @param SuitwalkOptions $suitwalkOptions
     */
    public function __construct(SuitwalkOptions $suitwalkOptions)
    {
        $this->suitwalkOptions = $suitwalkOptions;
    }

    /**
     * @return SuitwalkOptions
     */
    public function __invoke()
    {
        return $this->suitwalkOptions;
    }
}
