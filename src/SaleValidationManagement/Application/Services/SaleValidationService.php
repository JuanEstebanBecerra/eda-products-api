<?php

namespace SaleValidationManagement\Application\Services;

use Illuminate\Support\Facades\DB;
use SaleValidationManagement\Application\Interfaces\Services\SaleValidationServiceInterface;
use SaleValidationManagement\Domain\Dto\ProductStockUpdateDto;
use SaleValidationManagement\Domain\Exceptions\ProductNotFoundException;
use SaleValidationManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;

class SaleValidationService implements SaleValidationServiceInterface
{
    /**
     * @var bool
     */
    private bool $isSaleValid = true;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var array
     */
    private array $updatedProducts = [];

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $products
     * @return $this
     */
    public function validateProducts(array $products): self
    {
        $this->isSaleValid = true;
        $this->updatedProducts = [];
        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                $this->validateProductStock($product);
                if (!$this->isSaleValid) break;
            }
        } catch (ProductNotFoundException $e) {
            $this->isSaleValid = false;
        }

        if ($this->isSaleValid) DB::commit();
        else DB::rollBack();

        return $this;
    }

    /**
     * @param array $product
     * @return void
     * @throws ProductNotFoundException
     */
    private function validateProductStock(array $product): void
    {
        $stock = $this->productRepository
            ->getStockById($product['productId']);

        var_dump([
            'product' => $product['productId'],
            'stock' => $stock,
            'amount' => $product['amount'],
        ]);

        if ($stock < $product['amount'] || $product['amount'] <= 0) {
            $this->isSaleValid = false;
            return;
        }

        $this->updatedProducts[] = [
            'productId' => $product['productId'],
            'stock' => $stock - $product['amount']
        ];

        $this->productRepository->updateStock(
            $product['productId'],
            $stock - $product['amount']
        );
    }

    /**
     * @return bool
     */
    public function getIsSaleValid(): bool
    {
        return $this->isSaleValid;
    }

    /**
     * @return array
     */
    public function getUpdatedProducts(): array
    {
        return $this->updatedProducts;
    }
}
