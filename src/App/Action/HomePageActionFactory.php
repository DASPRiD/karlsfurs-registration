<?php
namespace App\Action;

use App\Action\HomePageAction;
use App\Helper\LoginHelper;
use App\Repository\AttendeeRepository;
use App\Repository\GroupRepository;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new HomePageAction(
            $container->get(TemplateRendererInterface::class),
            $container->get(GroupRepository::class),
            $container->get(AttendeeRepository::class),
            $container->get('doctrine.entity_manager.orm_default'),
            $container->get(LoginHelper::class)
        );
    }
}
