<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Dflydev\FigCookies\Cookies;
use Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Handler\SetLocaleHandler;

final class LocaleDetectionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        return $handler->handle($request->withAttribute('locale', $this->discoverLocale($request)));
    }

    private function discoverLocale(ServerRequestInterface $request) : string
    {
        $cookies = Cookies::fromRequest($request);

        if ($cookies->has('locale') && in_array($cookies->get('locale')->getValue(), SetLocaleHandler::AVAILABLE_LOCALES)) {
            return $cookies->get('locale')->getValue();
        }

        $serverParams = $request->getServerParams();

        if (!array_key_exists('HTTP_ACCEPT_LANGUAGE', $serverParams)) {
            return 'en-US';
        }

        $bestLocale = Locale::acceptFromHttp($serverParams['HTTP_ACCEPT_LANGUAGE']);

        if ('de' === Locale::getPrimaryLanguage($bestLocale)) {
            return 'de-DE';
        }

        return 'en-US';
    }
}
