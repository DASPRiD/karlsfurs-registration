<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use DateTimeImmutable;
use Dflydev\FigCookies\SetCookie;
use Dflydev\FigCookies\SetCookies;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;

final class SetLocale
{
    const AVAILABLE_LOCALES = ['de-DE', 'en-US'];

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $locale = $request->getAttribute('locale');

        if (!in_array($locale, self::AVAILABLE_LOCALES)) {
            return new RedirectResponse($this->urlHelper->generate('home'));
        }

        $setCookies = new SetCookies([
            SetCookie::create('locale', $locale)
                ->withExpires(new DateTimeImmutable('+365 days'))
                ->withPath('/')
                ->withHttpOnly(true)
        ]);
        return $setCookies->renderIntoSetCookieHeader(new RedirectResponse($this->urlHelper->generate('home')));
    }
}
