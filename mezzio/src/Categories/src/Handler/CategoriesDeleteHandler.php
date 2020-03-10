<?php

declare(strict_types=1);

namespace Categories\Handler;

use Categories\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CategoriesDeleteHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $halResponseFactory;
    protected $resourceGenerator;
    /**
     * CategoriesCreateHandler constructor.
     * @param EntityManager $entityManager
     * @param HalResponseFactory $halResponseFactory
     * @param ResourceGenerator $resourceGenerator
     */
    public function __construct(EntityManager $entityManager, HalResponseFactory $halResponseFactory, ResourceGenerator $resourceGenerator)
    {
        $this->entityManager = $entityManager;
        $this->halResponseFactory = $halResponseFactory;
        $this->resourceGenerator = $resourceGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $result = [];

        $entityRepository = $this->entityManager->getRepository(Category::class);

        $entity = $entityRepository->find($request->getAttribute('id'));

        // Verify if has a record from id
        if (empty($entity))
        {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found.';

            return new JsonResponse($result, 404);
        }

        try {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $result['_error']['error'] = 'not_removed';
            $result['_error']['error_description'] = $e->getMessage();

            return new JsonResponse($result, 400);
        }

        $result['Result']['_embedded']['Categories']= ['deleted_id' => $request->getAttribute('id')];

        return new JsonResponse($result);
    }
}
