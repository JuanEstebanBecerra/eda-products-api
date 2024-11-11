<?php

namespace SupplierManagement\Application\Mappers;

use Illuminate\Http\Request;
use Kernel\Application\Mappers\BaseMapper;
use SupplierManagement\Domain\Dto\SupplierNewDto;

class SupplierNewDtoMapper extends BaseMapper
{
    /**
     * @return SupplierNewDto
     */
    protected function getNewDto(): SupplierNewDto
    {
        return new SupplierNewDto();
    }

    /**
     * @param Request $request
     * @return SupplierNewDto
     */
    public function createFromRequest(Request $request): SupplierNewDto
    {
        $dto = $this->getNewDto();
        $dto->name = $request->name;
        $dto->nit = $request->nit;
        $dto->email = $request->email;
        $dto->phoneNumber = $request->phoneNumber;

        return $dto;
    }

}
