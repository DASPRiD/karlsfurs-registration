<?php
namespace App\Helper;

use Locale;
use Psr\Http\Message\ServerRequestInterface;
use Zend\I18n\Translator\Translator;
use Zend\Session\Container;
use Zend\Stratigility\Http\ResponseInterface;

class LocaleMiddleware
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Translator $translator
     * @param Container $container
     */
    public function __construct(Translator $translator, Container $container)
    {
        $this->translator = $translator;
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (isset($this->container->locale)) {
            $this->translator->setLocale($this->container->locale);
            return $next($request, $response);
        }

        $serverParams = $request->getServerParams();

        if (array_key_exists('HTTP_ACCEPT_LANGUAGE', $serverParams)) {
            $bestLocale = Locale::acceptFromHttp($serverParams['HTTP_ACCEPT_LANGUAGE']);

            if ('de' === Locale::getPrimaryLanguage($bestLocale)) {
                $this->container->locale = 'de-DE';
            } else {
                $this->container->locale = 'en-US';
            }

            $this->translator->setLocale($this->container->locale);
        }

        return $next($request, $response);
    }
}
