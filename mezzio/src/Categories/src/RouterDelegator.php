<?php
namespace Categories;

use Categories\Handler;
use Psr\Container\ContainerInterface;

class RouterDelegator
{
    /**
     * @param ContainerInterface $container
     * @param $serviceName
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        $app = $callback();

        // Setup Routes
        // List View
        $app->get('/api/categories/[?page={page:\d+}]', Handler\CategoriesListHandler::class, 'categories.list');
        // Find
        $app->get('/api/category/{id: \d+}[/]',  Handler\CategoriesViewHandler::class, 'category.view');
        // Create
        $app->post('/api/category[/]', Handler\CategoriesCreateHandler::class, 'category.create');
        // Update
        $app->put('/api/category/{id: \d+}[/]', Handler\CategoriesUpdateHandler::class, 'category.update');
        // Delete
        $app->delete('/api/category/{id: \d+}[/]', Handler\CategoriesDeleteHandler::class, 'category.delete');

        return $app;
    }
}