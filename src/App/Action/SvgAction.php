<?php
namespace App\Action;

use App\Repository\GroupRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;
use Zend\Expressive\Template\TemplateRendererInterface;

class SvgAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct(
        TemplateRendererInterface $template,
        GroupRepository $groupRepository
    ) {
        $this->template = $template;
        $this->groupRepository = $groupRepository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($this->template->render('app::svg', [
            'groups' => $this->groupRepository->findAll(),
            'layout' => 'layout::svg',
        ]));
        $body->rewind();

        return new Response($body, 200, ['Content-Type' => 'image/svg+xml']);
    }
}
