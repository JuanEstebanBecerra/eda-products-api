<?php

namespace ProductManagement\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Kernel\Infrastructure\Repositories\BaseRepository;
use ProductManagement\Application\Mappers\ProductDtoMapper;
use ProductManagement\Domain\Dto\ProductDto;
use ProductManagement\Domain\Dto\ProductNewDto;
use ProductManagement\Domain\Dto\ProductUpdateDto;
use ProductManagement\Domain\Exceptions\ProductNotFoundException;
use ProductManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @param ProductNewDto $dto
     * @return ProductNewDto
     */
    public function store(ProductNewDto $dto): ProductNewDto
    {
        $id = DB::table('products')->insertGetId([
            'supplier_id' => $dto->supplierId,
            'name' => $dto->name,
            'stock' => $dto->stock,
            'created_at' => now(),
//            'user_who_created' => $this->user->id
        ]);

        $dto->id = $id;

        return $dto;
    }

    /**
     * @param ProductUpdateDto $dto
     * @return $this
     */
    public function update(ProductUpdateDto $dto): self
    {
        DB::table('products')
            ->where('id', '=', $dto->id)
            ->update([
                'supplier_id' => $dto->supplierId,
                'name' => $dto->name,
                'stock' => $dto->stock,
                'active' => $dto->active,
                'updated_at' => now(),
//                'user_who_updated' => $this->user->id
            ]);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return collect(DB::select('SELECT
                products.id,
                products.name,
                products.stock,
                suppliers.name as supplier_name,
                suppliers.id as supplier_id
        FROM products
            inner join suppliers
                on products.supplier_id = suppliers.id
        order by products.id'));
    }

    /**
     * @param int $id
     * @return ProductDto
     * @throws ProductNotFoundException
     */
    public function findById(int $id): ProductDto
    {
        $dbRecord = DB::table('products')->where('id', $id)->first();
        if(is_null($dbRecord)) throw new ProductNotFoundException();

        return (new ProductDtoMapper())->createFromDbRecord($dbRecord);
    }
}
