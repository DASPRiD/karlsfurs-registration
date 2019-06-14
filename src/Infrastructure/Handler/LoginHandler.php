<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Handler;

use DASPRiD\Helios\IdentityCookieManager;
use DateTimeImmutable;
use Exception;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Infrastructure\Response\ResponseRendererInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

final class LoginHandler implements RequestHandlerInterface
{
    /**
     * @var Signer
     */
    private $signer;

    /**
     * @var string
     */
    private $signatureKey;

    /**
     * @var string
     */
    private $verificationKey;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @var IdentityCookieManager
     */
    private $cookieManager;

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var ResponseRendererInterface
     */
    private $responseRenderer;

    public function __construct(
        Signer $signer,
        string $signatureKey,
        string $verificationKey,
        UrlHelper $urlHelper,
        IdentityCookieManager $cookieManager,
        TemplateRendererInterface $templateRenderer,
        ResponseRendererInterface $responseRenderer
    ) {
        $this->signer = $signer;
        $this->signatureKey = $signatureKey;
        $this->verificationKey = $verificationKey;
        $this->urlHelper = $urlHelper;
        $this->cookieManager = $cookieManager;
        $this->templateRenderer = $templateRenderer;
        $this->responseRenderer = $responseRenderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if ('POST' === $request->getMethod()) {
            $post = $request->getParsedBody();
            $emailAddress = $post['emailAddress'] ?? '';

            if (false === filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                return $this->responseRenderer->render('common::login', $request, [
                    'error' => 'invalid-email-address',
                ]);
            }

            $token = $this->generateToken($emailAddress);
            $messageData = json_decode($this->templateRenderer->render('common::login-email', [
                'token' => (string) $token,
                'locale' => $request->getAttribute('locale'),
            ]), true);

            $mail = new Message();
            $mail->setEncoding('UTF-8');
            $mail->setFrom('noreply@karlsfurs.de');
            $mail->setTo($emailAddress);
            $mail->setSubject($messageData['subject']);
            $mail->setBody($messageData['body']);

            $transport = new Sendmail();
            $transport->send($mail);

            return $this->responseRenderer->render('common::login', $request, [
                'success' => 'email-sent',
            ]);
        }

        $token = $this->parseToken($request->getAttribute('token'));

        if (null === $token || !$token->verify($this->signer, $this->verificationKey)) {
            return $this->responseRenderer->render('common::login', $request, [
                'error' => 'invalid-token',
            ]);
        }

        return $this->cookieManager->injectCookie(
            new RedirectResponse($this->urlHelper->generate('home')),
            $token->getClaim('emailAddress'),
            false
        );
    }

    /**
     * @return Token|null
     */
    private function parseToken(string $token)
    {
        try {
            $parsedToken = (new Parser())->parse($token);
        } catch (Exception $e) {
            return null;
        }

        if (!$parsedToken->validate(new ValidationData())) {
            return null;
        }

        return $parsedToken;
    }

    private function generateToken(string $emailAddress) : Token
    {
        $timestamp = (new DateTimeImmutable())->getTimestamp();

        $tokenBuilder = new Builder();
        $tokenBuilder->setIssuedAt($timestamp);
        $tokenBuilder->setExpiration($timestamp + 3600);
        $tokenBuilder->set('emailAddress', $emailAddress);
        $tokenBuilder->sign($this->signer, $this->signatureKey);

        return $tokenBuilder->getToken();
    }
}
