<?php

declare(strict_types=1);

namespace Categories;

use Categories\Entity\Category;
use Categories\Entity\CategoryCollection;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Hydrator\ReflectionHydrator;
use Mezzio\Application;
use Mezzio\Hal\Metadata\MetadataMap;
use Mezzio\Hal\Metadata\RouteBasedCollectionMetadata;
use Mezzio\Hal\Metadata\RouteBasedResourceMetadata;

/**
 * The configuration provider for the Categories module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'doctrine'     => $this->getDoctrineEntities(),
            MetadataMap::class => $this->getHalMetadataMap(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'delegators' => [
                Application::class => [
                    RouterDelegator::class,
                ]
            ],
            'invokables' => [
            ],
            'factories'  => [
                Handler\CategoriesListHandler::class => Handler\CategoriesListHandlerFactory::class,
                Handler\CategoriesCreateHandler::class => Handler\CategoriesCreateHandlerFactory::class,
                Handler\CategoriesDeleteHandler::class => Handler\CategoriesDeleteHandlerFactory::class,
                Handler\CategoriesUpdateHandler::class => Handler\CategoriesUpdateHandlerFactory::class,
                Handler\CategoriesViewHandler::class => Handler\CategoriesViewHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'categories'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getDoctrineEntities(): array
    {
        return [
            'driver'=> [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Categories\Entity' => 'category_entity'
                    ]
                ],
                'category_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ]
            ],
        ];
    }

    public function getHalMetadataMap(): array
    {
        return [
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Category::class,
                'route' => 'category.view',
                'extractor' => ReflectionHydrator::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => CategoryCollection::class,
                'collection_relation' => 'category',
                'route' => 'categories.list',
            ]
        ];
    }
}
