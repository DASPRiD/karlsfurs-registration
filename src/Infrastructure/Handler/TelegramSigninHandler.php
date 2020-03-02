<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;

final class TelegramSigninHandler implements RequestHandlerInterface
{
    /**
     * @var string
     */
    private $botToken;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @var IdentityCookieManager
     */
    private $cookieManager;

    public function __construct(string $botToken, UrlHelper $urlHelper, IdentityCookieManager $cookieManager)
    {
        $this->botToken = $botToken;
        $this->urlHelper = $urlHelper;
        $this->cookieManager = $cookieManager;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $secretKey = hash('sha256', $this->botToken, true);
        $queryParams = $request->getQueryParams();
        $checkData = [];

        if (!array_key_exists('hash', $queryParams)
            || !array_key_exists('id', $queryParams)
            || !array_key_exists('auth_date', $queryParams)
            || !array_key_exists('first_name', $queryParams)
        ) {
            return new RedirectResponse($this->urlHelper->generate('home'));
        }

        foreach ($queryParams as $key => $value) {
            if ($key === 'hash') {
                continue;
            }

            $checkData[] = $key . '=' . $value;
        }

        sort($checkData);
        $hash = hash_hmac('sha256', implode("\n", $checkData), $secretKey);

        if ($hash !== $queryParams['hash']) {
            return new RedirectResponse($this->urlHelper->generate('home'));
        }

        if (time() - $queryParams['auth_date'] > 86400) {
            return new RedirectResponse($this->urlHelper->generate('home'));
        }

        $emailAddress = $queryParams['id'] . '@telegram.local';

        return $this->cookieManager->injectCookie(
            new RedirectResponse($this->urlHelper->generate('home')),
            [
                'email_address' => $emailAddress,
                'display_name' => $queryParams['first_name'],
            ],
            false
        );
    }
}
