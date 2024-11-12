<?php

namespace SaleValidationManagement\Application\Interfaces\Services;

use SaleValidationManagement\Domain\Exceptions\ProductNotFoundException;

interface SaleValidationServiceInterface
{
    /**
     * @param array $products
     * @return $this
     */
    public function validateProducts(array $products): self;

    /**
     * @return bool
     */
    public function getIsSaleValid(): bool;

    /**
     * @return array
     */
    public function getUpdatedProducts(): array;
}
