<?php

namespace ProductManagement\Application\Interfaces\Services;

use Illuminate\Support\Collection;
use ProductManagement\Domain\Dto\ProductDto;
use ProductManagement\Domain\Dto\ProductNewDto;
use ProductManagement\Domain\Dto\ProductUpdateDto;
use ProductManagement\Domain\Exceptions\ProductNotFoundException;

interface ProductServiceInterface
{
    /**
     * @param ProductNewDto $dto
     * @return ProductNewDto
     */
    public function store(ProductNewDto $dto): ProductNewDto;

    /**
     * @param ProductUpdateDto $dto
     * @return self
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
