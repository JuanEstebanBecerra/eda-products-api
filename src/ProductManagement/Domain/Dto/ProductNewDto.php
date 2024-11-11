<?php

namespace ProductManagement\Domain\Dto;

use Kernel\Domain\Dto\BaseDto;

class ProductNewDto extends BaseDto
{
    /**
     * @var int|null
     */
    public ?int $id;

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
    public int $amount;
}
