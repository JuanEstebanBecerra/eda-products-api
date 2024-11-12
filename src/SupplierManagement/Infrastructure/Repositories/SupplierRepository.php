<?php

namespace SupplierManagement\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Kernel\Infrastructure\Repositories\BaseRepository;
use SupplierManagement\Application\Mappers\SupplierDtoMapper;
use SupplierManagement\Domain\Dto\SupplierDto;
use SupplierManagement\Domain\Dto\SupplierNewDto;
use SupplierManagement\Domain\Dto\SupplierUpdateDto;
use SupplierManagement\Domain\Exceptions\SupplierNotFoundException;
use SupplierManagement\Infrastructure\Interfaces\Repositories\SupplierRepositoryInterface;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    /**
     * @param SupplierNewDto $dto
     * @return SupplierNewDto
     */
    public function store(SupplierNewDto $dto): SupplierNewDto
    {
        $id = DB::table('suppliers')->insertGetId([
            'name' => $dto->name,
            'nit' => $dto->nit,
            'email' => $dto->email,
            'phone_number' => $dto->phoneNumber,
//            'created_at' => now(),
//            'user_who_created' => $this->user->id
        ]);

        $dto->id = $id;

        return $dto;
    }

    /**
     * @param SupplierUpdateDto $dto
     * @return $this
     */
    public function update(SupplierUpdateDto $dto): self
    {
        DB::table('suppliers')
            ->where('id', '=', $dto->id)
            ->update([
                'name' => $dto->name,
                'nit' => $dto->nit,
                'email' => $dto->email,
                'phone_number' => $dto->phoneNumber,
//                'updated_at' => now(),
//                'user_who_updated' => $this->user->id
            ]);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return collect(DB::select('SELECT id, name, nit, email, phone_number as phoneNumber FROM suppliers'));
    }

    /**
     * @param int $id
     * @return SupplierDto
     * @throws SupplierNotFoundException()
     */
    public function findById(int $id): SupplierDto
    {
        $dbRecord = DB::table('suppliers')
            ->where('id', $id)
            ->first();

        if (is_null($dbRecord)) throw new SupplierNotFoundException();

        return (new SupplierDtoMapper())->createFromDbRecord($dbRecord);
    }
}
