<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ResponseRendererInterface
{
    public function render(string $name, ServerRequestInterface $request, array $params = []) : ResponseInterface;
}
