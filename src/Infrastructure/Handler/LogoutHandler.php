<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;

final class LogoutHandler implements RequestHandlerInterface
{
    /**
     * @var IdentityCookieManager
     */
    private $cookieManager;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(IdentityCookieManager $cookieManager, UrlHelper $urlHelper)
    {
        $this->cookieManager = $cookieManager;
        $this->urlHelper = $urlHelper;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return $this->cookieManager->expireCookie(new RedirectResponse($this->urlHelper->generate('home')));
    }
}
