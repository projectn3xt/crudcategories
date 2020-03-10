<?php

declare(strict_types=1);

namespace Categories\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class CategoriesViewHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CategoriesViewHandler
    {
        return new CategoriesViewHandler(
            $container->get(EntityManager::class),
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class)
        );
    }
}
