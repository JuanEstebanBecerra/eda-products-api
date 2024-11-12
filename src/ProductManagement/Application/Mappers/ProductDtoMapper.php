<?php

namespace ProductManagement\Application\Mappers;

use Kernel\Application\Mappers\BaseMapper;
use ProductManagement\Domain\Dto\ProductDto;
use stdClass;

class ProductDtoMapper extends BaseMapper
{
    /**
     * @return ProductDto
     */
    protected function getNewDto(): ProductDto
    {
        return new ProductDto();
    }

    /**
     * @param stdClass $dbRecord
     * @return ProductDto
     */
    public function createFromDbRecord(stdClass $dbRecord): ProductDto
    {
        $dto = $this->getNewDto();
        $dto->name = $dbRecord->name;
        $dto->stock = $dbRecord->stock;

        return $dto;
    }

}
