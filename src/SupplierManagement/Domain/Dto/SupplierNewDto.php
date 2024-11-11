<?php

namespace SupplierManagement\Domain\Dto;

use Kernel\Domain\Dto\BaseDto;

class SupplierNewDto extends BaseDto
{
    /**
     * @var int|null
     */
    public ?int $id;

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
