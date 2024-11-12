<?php

namespace SaleValidationManagement\Infrastructure\Interfaces\EventHandlers;

interface StockVerificationEventHandlerInterface
{
    /**
     * @param array $message
     * @return void
     */
    public function onGetMessage(array $message): void;
}
