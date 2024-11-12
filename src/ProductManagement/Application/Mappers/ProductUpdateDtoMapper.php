<?php

namespace ProductManagement\Application\Mappers;

use Illuminate\Http\Request;
use Kernel\Application\Mappers\BaseMapper;
use ProductManagement\Domain\Dto\ProductUpdateDto;

class ProductUpdateDtoMapper extends BaseMapper
{
    /**
     * @return ProductUpdateDto
     */
    protected function getNewDto(): ProductUpdateDto
    {
        return new ProductUpdateDto();
    }

    /**
     * @param Request $request
     * @return ProductUpdateDto
     */
    public function createFromRequest(Request $request): ProductUpdateDto
    {
        $dto = $this->getNewDto();
        $dto->supplierId = $request->supplierId;
        $dto->name = $request->name;
        $dto->stock = $request->stock;
        $dto->active = $request->active;

        return $dto;
    }

}
