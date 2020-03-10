<?php

declare(strict_types=1);

namespace Categories\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class CategoriesCreateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CategoriesCreateHandler
    {
        return new CategoriesCreateHandler(
            $container->get(EntityManager::class),
            $container->get(HalResponseFactory::class),
            $container->get(ResourceGenerator::class)
        );
    }
}
