<?php
declare(strict_types=1);

namespace Categories\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package Categories\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */

class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=false)
     */
    protected $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategory(): String
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(String $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @throws \Exception
     */
    public function setCreatedAt(\DateTime $createdAt = null): void
    {
        if(!$createdAt && empty($this->getId()))
            $this->createdAt = new \DateTime("now");
        else
            $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @throws \Exception
     */
    public function setUpdatedAt(\DateTime $updatedAt = null): void
    {
        if(!$updatedAt)
            $this->updatedAt = new \DateTime("now");
        else
            $this->updatedAt = $updatedAt;
    }

    /**
     * @param array $requestBody
     * @throws \Exception
     */
    public function setCategories(array $requestBody): void
    {
        if(isset($requestBody['category']))
            $this->setCategory($requestBody['category']);
        if(isset($requestBody['description']))
            $this->setDescription($requestBody['description']);

        $this->setUpdatedAt(new \DateTime('now'));
    }

}