<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Group\GetAllGroupsInterface;
use Suitwalk\Domain\History\GetHistoryInterface;
use Suitwalk\Infrastructure\Response\ResponseRendererInterface;

final class History
{
    /**
     * @var GetAllGroupsInterface
     */
    private $getAllGroups;

    /**
     * @var GetHistoryInterface
     */
    private $getHistory;

    /**
     * @var ResponseRendererInterface
     */
    private $responseRenderer;

    public function __construct(
        GetAllGroupsInterface $getAllGroups,
        GetHistoryInterface $getHistory,
        ResponseRendererInterface $responseRenderer
    ) {
        $this->getAllGroups = $getAllGroups;
        $this->getHistory = $getHistory;
        $this->responseRenderer = $responseRenderer;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        return $this->responseRenderer->render('common::history', $request, [
            'history' => $this->getHistory->__invoke($this->getAllGroups->__invoke()),
        ]);
    }
}
