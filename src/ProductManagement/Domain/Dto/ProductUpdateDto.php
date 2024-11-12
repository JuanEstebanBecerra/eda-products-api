<?php

namespace ProductManagement\Domain\Dto;

use Kernel\Domain\Dto\BaseDto;

class ProductUpdateDto extends BaseDto
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var int
     */
    public int $supplierId;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var int
     */
    public int $stock;

    /**
     * @var bool
     */
    public bool $active;
}
