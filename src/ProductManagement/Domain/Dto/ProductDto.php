<?php

namespace ProductManagement\Domain\Dto;

use Kernel\Domain\Dto\BaseDto;

class ProductDto extends BaseDto
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
    public string $supplierName;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var int
     */
    public int $amount;

    /**
     * @var bool
     */
    public bool $active;
}
