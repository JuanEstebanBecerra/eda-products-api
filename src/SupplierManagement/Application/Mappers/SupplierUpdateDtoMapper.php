<?php

namespace SupplierManagement\Application\Mappers;

use Illuminate\Http\Request;
use Kernel\Application\Mappers\BaseMapper;
use SupplierManagement\Domain\Dto\SupplierUpdateDto;

class SupplierUpdateDtoMapper extends BaseMapper
{
    /**
     * @return SupplierUpdateDto
     */
    protected function getNewDto(): SupplierUpdateDto
    {
        return new SupplierUpdateDto();
    }

    /**
     * @param Request $request
     * @return SupplierUpdateDto
     */
    public function createFromRequest(Request $request): SupplierUpdateDto
    {
        $dto = $this->getNewDto();
        $dto->name = $request->name;
        $dto->nit = $request->nit;
        $dto->email = $request->email;
        $dto->phoneNumber = $request->phoneNumber;

        return $dto;
    }

}
