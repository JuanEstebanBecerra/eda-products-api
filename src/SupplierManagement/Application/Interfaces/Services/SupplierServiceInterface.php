<?php

namespace SupplierManagement\Application\Interfaces\Services;

use Illuminate\Support\Collection;
use SupplierManagement\Domain\Dto\SupplierDto;
use SupplierManagement\Domain\Dto\SupplierNewDto;
use SupplierManagement\Domain\Dto\SupplierUpdateDto;
use SupplierManagement\Domain\Exceptions\SupplierNotFoundException;

interface SupplierServiceInterface
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
