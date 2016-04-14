<?php
namespace App\Action;

use App\Repository\GroupRepository;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class SvgActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SvgAction(
            $container->get(TemplateRendererInterface::class),
            $container->get(GroupRepository::class)
        );
    }
}
