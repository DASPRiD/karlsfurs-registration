<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Medium\GetAllMediaInterface;
use Suitwalk\Infrastructure\Response\ResponseRendererInterface;

final class Media
{
    /**
     * @var GetAllMediaInterface
     */
    private $getAllMedia;

    /**
     * @var ResponseRendererInterface
     */
    private $responseRenderer;

    public function __construct(GetAllMediaInterface $getAllMedia, ResponseRendererInterface $responseRenderer)
    {
        $this->getAllMedia = $getAllMedia;
        $this->responseRenderer = $responseRenderer;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        return $this->responseRenderer->render('common::media', $request, [
            'media' => $this->getAllMedia->getAll(),
        ]);
    }
}
