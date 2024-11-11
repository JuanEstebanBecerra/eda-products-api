<?php

namespace SupplierManagement\Application\Services;

use Illuminate\Support\Collection;
use SupplierManagement\Application\Interfaces\Services\SupplierServiceInterface;
use SupplierManagement\Domain\Dto\SupplierDto;
use SupplierManagement\Domain\Dto\SupplierNewDto;
use SupplierManagement\Domain\Dto\SupplierUpdateDto;
use SupplierManagement\Domain\Exceptions\SupplierNotFoundException;
use SupplierManagement\Infrastructure\Interfaces\Repositories\SupplierRepositoryInterface;

class SupplierService implements SupplierServiceInterface
{
    /**
     * @var SupplierRepositoryInterface
     */
    private SupplierRepositoryInterface $supplierRepository;

    /**
     * @param SupplierRepositoryInterface $supplierRepository
     */
    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param SupplierNewDto $dto
     * @return SupplierNewDto
     */
    public function store(SupplierNewDto $dto): SupplierNewDto
    {
        return $this->supplierRepository
//            ->setUser(auth()->user())
            ->store($dto);
    }

    /**
     * @param SupplierUpdateDto $dto
     * @return $this
     */
    public function update(SupplierUpdateDto $dto): self
    {
        $this->supplierRepository
//            ->setUser(auth()->user())
            ->update($dto);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->supplierRepository
            ->getAll();
    }

    /**
     * @param int $id
     * @return SupplierDto
     * @throws SupplierNotFoundException()
     */
    public function findById(int $id): SupplierDto
    {
        return $this->supplierRepository
            ->findById($id);
    }
}
