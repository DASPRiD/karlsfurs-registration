<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Psr\Http\Message\ResponseInterface;
use Soliant\AgroLiquid\Infrastructure\Response\ResponseRendererInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

final class Svg
{
    /**
     * @var GetAllGroupsInterface
     */
    private $getAllGroup;

    /**
     * @var ResponseRendererInterface
     */
    private $templateRenderer;

    public function __invoke() : ResponseInterface
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($this->templateRenderer->render('app::svg', [
            'groups' => $this->getAllGroup->getAll(),
        ]));
        $body->rewind();

        return new Response($body, 200, ['Content-Type' => 'image/svg+xml']);
    }
}
