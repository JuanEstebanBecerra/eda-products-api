<?php

namespace SaleValidationManagement\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Kernel\Infrastructure\Repositories\BaseRepository;
use SaleValidationManagement\Domain\Exceptions\ProductNotFoundException;
use SaleValidationManagement\Domain\Dto\ProductStockUpdateDto;
use SaleValidationManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @param int $id
     * @return int
     * @throws ProductNotFoundException
     */
    public function getStockById(int $id): int
    {
        $dbRecord = DB::table('products')->where('id', $id)->first();
        if (is_null($dbRecord)) throw new ProductNotFoundException();

        return $dbRecord->stock;
    }

    /**
     * @param int $id
     * @param int $stock
     * @return $this
     */
    public function updateStock(int $id, int $stock): self
    {
        DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'stock' => $stock,
                'updated_at' => now(),
//                'user_who_updated' => $this->user->id
            ]);

        return $this;
    }
}
