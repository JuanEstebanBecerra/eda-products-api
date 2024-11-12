<?php

namespace SupplierManagement\Domain\Exceptions;

use Exception;

class SupplierNotFoundException extends Exception
{
    /**
     * @var int
     */
    protected $code = 404;

    /**
     * @var string
     */
    protected $message = 'Proveedor no encontrado';
}
