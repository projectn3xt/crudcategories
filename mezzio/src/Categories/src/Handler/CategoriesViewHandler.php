<?php

declare(strict_types=1);

namespace Categories\Handler;

use Categories\Entity\Category;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CategoriesViewHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $resourceGenerator;
    protected $halResponseFactory;

    /**
     * CategoriesReadHandler constructor.
     * @param EntityManager $entityManager
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $halResponseFactory
     */
    public function __construct(
        EntityManager $entityManager,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory
    )
    {
        $this->entityManager = $entityManager;
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $result = [];

        $entityRepository = $this->entityManager->getRepository(Category::class);

        $entity = $entityRepository->find($request->getAttribute('id', null));

        // Verify if has a record from id
        if (empty($entity))
        {
            $result['_error']['error'] = 'not_found';
            $result['_error']['error_description'] = 'Record not found.';

            return new JsonResponse($result, 404);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return $this->halResponseFactory->createResponse($request, $resource);

    }
}
