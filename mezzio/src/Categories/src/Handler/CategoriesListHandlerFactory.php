<?php

declare(strict_types=1);

namespace Categories\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class CategoriesListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CategoriesListHandler
    {
        return new CategoriesListHandler(
            $container->get(EntityManager::class),
            $container->get('config')['page_size'],
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class)
        );
    }
}
