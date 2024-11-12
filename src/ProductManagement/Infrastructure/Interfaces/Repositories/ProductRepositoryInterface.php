<?php

namespace ProductManagement\Infrastructure\Interfaces\Repositories;

use Illuminate\Support\Collection;
use Kernel\Infrastructure\Interfaces\Repositories\BaseRepositoryInterface;
use ProductManagement\Domain\Dto\ProductDto;
use ProductManagement\Domain\Dto\ProductNewDto;
use ProductManagement\Domain\Dto\ProductUpdateDto;
use ProductManagement\Domain\Exceptions\ProductNotFoundException;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @param ProductNewDto $dto
     * @return ProductNewDto
     */
    public function store(ProductNewDto $dto): ProductNewDto;

    /**
     * @param ProductUpdateDto $dto
     * @return $this
     */
    public function update(ProductUpdateDto $dto): self;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return ProductDto
     * @throws ProductNotFoundException
     */
    public function findById(int $id): ProductDto;
}
