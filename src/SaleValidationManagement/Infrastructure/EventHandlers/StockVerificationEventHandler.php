<?php

namespace SaleValidationManagement\Infrastructure\EventHandlers;

use Carbon\Exceptions\Exception;
use Junges\Kafka\Contracts\ConsumerMessage;
use Junges\Kafka\Contracts\MessageConsumer;
use Junges\Kafka\Exceptions\ConsumerException;
use Junges\Kafka\Facades\Kafka;
use SaleValidationManagement\Application\Interfaces\Services\SaleValidationServiceInterface;
use SaleValidationManagement\Infrastructure\Interfaces\EventHandlers\SaleValidationEventHandlerInterface;
use SaleValidationManagement\Infrastructure\Interfaces\EventHandlers\StockVerificationEventHandlerInterface;

class StockVerificationEventHandler implements StockVerificationEventHandlerInterface
{
    /**
     * @var SaleValidationServiceInterface
     */
    private SaleValidationServiceInterface $saleValidationService;

    /**
     * @var SaleValidationEventHandlerInterface
     */
    private SaleValidationEventHandlerInterface $saleValidationEventHandler;

    /**
     * @throws ConsumerException
     * @throws Exception
     */
    public function __construct(
        SaleValidationServiceInterface      $saleValidationService,
        SaleValidationEventHandlerInterface $saleValidationEventHandler
    )
    {
        $this->saleValidationService = $saleValidationService;
        $this->saleValidationEventHandler = $saleValidationEventHandler;
        $this->setupConsumer();
    }

    /**
     * @return void
     * @throws ConsumerException
     * @throws Exception
     */
    private function setupConsumer(): void
    {
        $consumer = Kafka::consumer()
            ->subscribe('stock_verification')
            ->withHandler(function (ConsumerMessage $message, MessageConsumer $consumer) {
                $this->onGetMessage($message->getBody());
            })->build();


        $consumer->consume();
    }

    /**
     * @param array $message
     * @return void
     */
    public function onGetMessage(array $message): void
    {
        $isValid = $this->saleValidationService
            ->validateProducts($message['data']['products'])
            ->getIsSaleValid();

        var_dump($isValid);

        $this->saleValidationEventHandler
            ->sendMessage([
                'action' => 'sale_validation',
                'data' => [
                    'saleId' => $message['data']['saleId'],
                    'isValid' => $isValid,
                ]
            ]);
    }
}
