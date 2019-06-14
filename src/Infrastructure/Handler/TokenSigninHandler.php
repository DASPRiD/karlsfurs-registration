<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use Google_Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

final class TokenSigninHandler implements RequestHandlerInterface
{
    /**
     * @var Google_Client
     */
    private $googleClient;

    /**
     * @var IdentityCookieManager
     */
    private $cookieManager;

    public function __construct(Google_Client $googleClient, IdentityCookieManager $cookieManager)
    {
        $this->googleClient = $googleClient;
        $this->cookieManager = $cookieManager;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $postParams = $request->getParsedBody();

        if (!array_key_exists('idToken', $postParams)) {
            return new JsonResponse(['message' => 'Missing idToken'], 400);
        }

        $payload = $this->googleClient->verifyIdToken($postParams['idToken']);

        if (! $payload) {
            return new JsonResponse(['message' => 'Invalid idToken'], 400);
        }

        $emailAddress = $payload['email'];

        return $this->cookieManager->injectCookie(
            new JsonResponse([], 200),
            $emailAddress,
            false
        );
    }
}
