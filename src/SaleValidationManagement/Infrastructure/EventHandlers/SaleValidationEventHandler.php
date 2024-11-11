<?php

namespace SaleValidationManagement\Infrastructure\EventHandlers;

use Exception;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use SaleValidationManagement\Infrastructure\Interfaces\EventHandlers\SaleValidationEventHandlerInterface;

class SaleValidationEventHandler implements SaleValidationEventHandlerInterface
{
    /**
     * @param array $message
     * @return void
     * @throws Exception
     */
    public function sendMessage(array $message): void
    {
        $message = new Message(
            body: $message,
        );

        Kafka::asyncPublish()
            ->onTopic('sale_validation')
            ->withMessage($message)
            ->send();
    }

}
