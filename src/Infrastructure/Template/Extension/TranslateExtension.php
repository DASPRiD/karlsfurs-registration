<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Template\Extension;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Suitwalk\Infrastructure\I18n\Translator;
use Zend\I18n\Translator\TranslatorInterface;

final class TranslateExtension implements ExtensionInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('getTranslator', [$this, 'getTranslator']);
    }

    public function getTranslator(string $locale) : Translator
    {
        return new Translator($this->translator, $locale);
    }
}
