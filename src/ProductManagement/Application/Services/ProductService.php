<?php

namespace ProductManagement\Application\Services;

use Illuminate\Support\Collection;
use ProductManagement\Application\Interfaces\Services\ProductServiceInterface;
use ProductManagement\Domain\Dto\ProductDto;
use ProductManagement\Domain\Dto\ProductNewDto;
use ProductManagement\Domain\Dto\ProductUpdateDto;
use ProductManagement\Domain\Exceptions\ProductNotFoundException;
use ProductManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductNewDto $dto
     * @return ProductNewDto
     */
    public function store(ProductNewDto $dto): ProductNewDto
    {
        return $this->productRepository
            ->setUser(auth()->user())
            ->store($dto);
    }

    /**
     * @param ProductUpdateDto $dto
     * @return self
     */
    public function update(ProductUpdateDto $dto): self
    {
        $this->productRepository
            ->setUser(auth()->user())
            ->update($dto);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->productRepository
            ->getAll();
    }

    /**
     * @param int $id
     * @return ProductDto
     * @throws ProductNotFoundException
     */
    public function findById(int $id): ProductDto
    {
        return $this->productRepository
            ->findById($id);
    }
}
