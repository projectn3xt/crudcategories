<?php

declare(strict_types=1);

namespace Categories\Handler;

use Categories\Entity\Category;
use Categories\Entity\CategoryCollection;
use Doctrine\ORM\EntityManager;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CategoriesListHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;
    protected $resourceGenerator;
    protected $halResponseFactory;

    /**
     * CategoriesReadHandler constructor.
     * @param EntityManager $entityManager
     * @param int $pageCount
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $halResponseFactory
     */
    public function __construct(
        EntityManager $entityManager,
        int $pageCount,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory
    )
    {
        $this->entityManager = $entityManager;
        $this->pageCount = $pageCount;
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        // Retrieve all items
        $repository = $this->entityManager->getRepository(Category::class);

        $query = $repository
            ->createQueryBuilder('c')
            ->addOrderBy('c.id', 'asc')
            ->setMaxResults($this->pageCount)
            ->getQuery();

        $paginator = new CategoryCollection($query);

        $resource =  $this->resourceGenerator->fromObject($paginator, $request);

        return $this->halResponseFactory->createResponse($request, $resource);
    }
}
