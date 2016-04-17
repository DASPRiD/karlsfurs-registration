<?php
namespace App\Action;

use App\Helper\LoginHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Session\Container;

class LanguageAction
{
    const AVAILABLE_LOCALES = ['de-DE', 'en-US'];

    /**
     * @var Container
     */
    private $container;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @param Container $container
     * @param UrlHelper $urlHelper
     */
    public function __construct(
        Container $container,
        UrlHelper $urlHelper
    ) {
        $this->container = $container;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $locale = $request->getAttribute('locale');

        if (in_array($locale, self::AVAILABLE_LOCALES)) {
            $this->container->locale = $locale;
        }

        return new RedirectResponse($this->urlHelper->generate('home'));
    }
}
