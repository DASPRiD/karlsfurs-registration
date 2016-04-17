<?php
namespace App\Helper;

use MessageFormatter;
use Zend\View\Helper\AbstractHelper;

class MessageFormatHelper extends AbstractHelper
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $pattern
     * @param array $args
     * @return string
     */
    public function __invoke($pattern, array $args)
    {
        return MessageFormatter::formatMessage($this->locale, $pattern, $args);
    }
}
