<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\I18n;

use DateTime;
use DateTimeImmutable;
use MessageFormatter;
use Zend\I18n\Translator\TranslatorInterface;

final class Translator
{
    /**
     * @var TranslatorInterface
     */
    private $wrappedTranslator;

    /**
     * @var string
     */
    private $locale;

    public function __construct(TranslatorInterface $wrappedTranslator, string $locale)
    {
        $this->wrappedTranslator = $wrappedTranslator;
        $this->locale = $locale;
    }

    public function translate(string $key, array $arguments = [])
    {
        $message = $this->wrappedTranslator->translate($key, 'default', $this->locale);

        if (empty($arguments)) {
            return $message;
        }

        foreach ($arguments as $key => $value) {
            if ($value instanceof DateTimeImmutable) {
                $arguments[$key] = DateTime::createFromFormat(DateTime::ISO8601, $value->format(DateTime::ISO8601));
            }
        }

        return MessageFormatter::formatMessage($this->locale, $message, $arguments);
    }
}
