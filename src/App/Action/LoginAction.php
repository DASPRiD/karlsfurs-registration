<?php
namespace App\Action;

use App\Helper\LoginHelper;
use DateTime;
use Exception;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Validator\EmailAddress;

class LoginAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

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
     * @var LoginHelper
     */
    private $loginHelper;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @param TemplateRendererInterface $template
     * @param Signer $signer
     * @param string $signatureKey
     * @param string $verificationKey
     * @param LoginHelper $loginHelper
     * @param UrlHelper $urlHelper
     */
    public function __construct(
        TemplateRendererInterface $template,
        Signer $signer,
        $signatureKey,
        $verificationKey,
        LoginHelper $loginHelper,
        UrlHelper $urlHelper
    ) {
        $this->template = $template;
        $this->signer = $signer;
        $this->signatureKey = $signatureKey;
        $this->verificationKey = $verificationKey;
        $this->loginHelper = $loginHelper;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ('POST' === $request->getMethod()) {
            $inputFilter = $this->getInputFilter();
            $inputFilter->setData($request->getParsedBody());

            if (!$inputFilter->isValid()) {
                return new HtmlResponse($this->template->render('app::login', [
                    'error' => 'invalid-email-address',
                ]));
            }

            $emailAddress = $inputFilter->getValue('emailAddress');
            $token = $this->generateToken($emailAddress);
            $messageData = json_decode($this->template->render('app::login-email', [
                'token' => (string) $token,
                'layout' => 'layout::email',
            ]), true);

            $mail = new Message();
            $mail->setEncoding('UTF-8');
            $mail->setFrom('noreply@karlsfurs.de');
            $mail->setTo($emailAddress);
            $mail->setSubject($messageData['subject']);
            $mail->setBody($messageData['body']);

            $transport = new Sendmail();
            $transport->send($mail);

            return new HtmlResponse($this->template->render('app::login', [
                'success' => 'email-sent',
            ]));
        }

        $token = $this->parseToken($request->getAttribute('token'));

        if (null === $token || !$token->verify($this->signer, $this->verificationKey)) {
            return new HtmlResponse($this->template->render('app::login', [
                'error' => 'invalid-token',
            ]));
        }

        $this->loginHelper->setEmailAddress($token->getClaim('emailAddress'));
        return new RedirectResponse($this->urlHelper->generate('home'));
    }

    /**
     * @param string $token
     * @return Token
     */
    private function parseToken($token)
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

    /**
     * @param string $emailAddress
     * @return Token
     */
    private function generateToken($emailAddress)
    {
        $timestamp = (new DateTime())->getTimestamp();

        $tokenBuilder = new Builder();
        $tokenBuilder->setIssuedAt($timestamp);
        $tokenBuilder->setExpiration($timestamp + 3600);
        $tokenBuilder->set('emailAddress', $emailAddress);
        $tokenBuilder->sign($this->signer, $this->signatureKey);

        return $tokenBuilder->getToken();
    }

    /**
     * @return InputFilter
     */
    private function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $inputFilter->add([
            'name' => 'emailAddress',
            'filters' => [
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => EmailAddress::class],
            ],
        ]);

        return $inputFilter;
    }
}
