<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Dflydev\FigCookies\Cookies;
use Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LocaleDetection
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next) : ResponseInterface
    {
        return $next($request->withAttribute('locale', $this->discoverLocale($request)), $response);
    }

    private function discoverLocale(ServerRequestInterface $request) : string
    {
        $cookies = Cookies::fromRequest($request);

        if ($cookies->has('locale') && in_array($cookies->get('locale')->getValue(), SetLocale::AVAILABLE_LOCALES)) {
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
