<?php

namespace ProductManagement\Application\Mappers;

use Illuminate\Http\Request;
use Kernel\Application\Mappers\BaseMapper;
use Kernel\Domain\Dto\BaseDto;
use ProductManagement\Domain\Dto\ProductNewDto;

class ProductNewDtoMapper extends BaseMapper
{
    /**
     * @return ProductNewDto
     */
    protected function getNewDto(): ProductNewDto
    {
        return new ProductNewDto();
    }

    /**
     * @param Request $request
     * @return ProductNewDto
     */
    public function createFromRequest(Request $request): ProductNewDto
    {
        $dto = $this->getNewDto();
        $dto->supplierId = $request->supplierId;
        $dto->name = $request->name;
        $dto->amount = $request->amount;

        return $dto;
    }

}
