<?php

namespace SupplierManagement\Domain\Dto;

use Kernel\Domain\Dto\BaseDto;

class SupplierUpdateDto extends BaseDto
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $nit;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $phoneNumber;
}
