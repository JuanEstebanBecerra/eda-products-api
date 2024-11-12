<?php

namespace SaleValidationManagement\Domain\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    /**
     * @var int
     */
    protected $code = 404;

    /**
     * @var string
     */
    protected $message = 'Producto no encontrado';
}
