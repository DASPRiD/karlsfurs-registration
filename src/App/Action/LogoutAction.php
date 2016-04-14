<?php
namespace App\Action;

use App\Helper\LoginHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;

class LogoutAction
{
    /**
     * @var LoginHelper
     */
    private $loginHelper;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @param LoginHelper $loginHelper
     * @param UrlHelper $urlHelper
     */
    public function __construct(
        LoginHelper $loginHelper,
        UrlHelper $urlHelper
    ) {
        $this->loginHelper = $loginHelper;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->loginHelper->setEmailAddress(null);
        return new RedirectResponse($this->urlHelper->generate('home'));
    }
}
