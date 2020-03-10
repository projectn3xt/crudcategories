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

class CategoriesCreateHandler implements RequestHandlerInterface
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

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $requestBody = $request->getParsedBody();

        if (empty($requestBody))
        {
           $result['_error']['error'] = 'missing_request';
           $result['_error']['error_description'] = 'No request body sent.';

           return new JsonResponse($result, 400);
        }

        $entity = new Category();

        try {
            $entity->setCategories($requestBody);
            $entity->setCreatedAt( new \DateTime("now"));

            // Persist Data
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (ORMException $e){
            $result['_error']['error'] = 'not_created';
            $result['_error']['error_description'] = $e->getMessage();

            return new JsonResponse($result, 400);
        }

        $resource = $this->resourceGenerator->fromObject($entity, $request);
        return $this->halResponseFactory->createResponse($request, $resource);

    }
}
