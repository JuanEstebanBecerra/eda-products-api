<?php

namespace SaleValidationManagement\Infrastructure\Interfaces\Repositories;

use Kernel\Infrastructure\Interfaces\Repositories\BaseRepositoryInterface;
use SaleValidationManagement\Domain\Dto\ProductStockUpdateDto;
use SaleValidationManagement\Domain\Exceptions\ProductNotFoundException;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $id
     * @return int
     * @throws ProductNotFoundException
     */
    public function getStockById(int $id): int;

    /**
     * @param int $id
     * @param int $stock
     * @return $this
     */
    public function updateStock(int $id, int $stock): self;
}
