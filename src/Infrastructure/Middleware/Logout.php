<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use DASPRiD\Helios\CookieManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;

final class Logout
{
    /**
     * @var CookieManagerInterface
     */
    private $cookieManager;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(CookieManagerInterface $cookieManager, UrlHelper $urlHelper)
    {
        $this->cookieManager = $cookieManager;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke() : ResponseInterface
    {
        return $this->cookieManager->expireTokenCookie(new RedirectResponse($this->urlHelper->generate('home')));
    }
}
