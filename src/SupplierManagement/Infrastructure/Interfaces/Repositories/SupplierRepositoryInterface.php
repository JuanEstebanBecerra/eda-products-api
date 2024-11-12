<?php

namespace SupplierManagement\Infrastructure\Interfaces\Repositories;

use Illuminate\Support\Collection;
use Kernel\Infrastructure\Interfaces\Repositories\BaseRepositoryInterface;
use SupplierManagement\Domain\Dto\SupplierDto;
use SupplierManagement\Domain\Dto\SupplierNewDto;
use SupplierManagement\Domain\Dto\SupplierUpdateDto;
use SupplierManagement\Domain\Exceptions\SupplierNotFoundException;

interface SupplierRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param SupplierNewDto $dto
     * @return SupplierNewDto
     */
    public function store(SupplierNewDto $dto): SupplierNewDto;

    /**
     * @param SupplierUpdateDto $dto
     * @return $this
     */
    public function update(SupplierUpdateDto $dto): self;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return SupplierDto
     * @throws SupplierNotFoundException()
     */
    public function findById(int $id): SupplierDto;
}
