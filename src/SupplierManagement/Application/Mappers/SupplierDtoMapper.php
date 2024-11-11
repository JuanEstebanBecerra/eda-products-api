<?php

namespace SupplierManagement\Application\Mappers;

use Kernel\Application\Mappers\BaseMapper;
use stdClass;
use SupplierManagement\Domain\Dto\SupplierDto;

class SupplierDtoMapper extends BaseMapper
{
    /**
     * @return SupplierDto
     */
    protected function getNewDto(): SupplierDto
    {
        return new SupplierDto();
    }

    /**
     * @param stdClass $dbRecord
     * @return SupplierDto
     */
    public function createFromDbRecord(stdClass $dbRecord): SupplierDto
    {
        $dto = $this->getNewDto();
        $dto->id = $dbRecord->id;
        $dto->name = $dbRecord->name;
        $dto->nit = $dbRecord->nit;
        $dto->email = $dbRecord->email;
        $dto->phoneNumber = $dbRecord->phone_number;

        return $dto;
    }

}
