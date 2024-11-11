<?php

namespace SaleValidationManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SaleValidationManagement\Application\Interfaces\Services\SaleValidationServiceInterface;
use SaleValidationManagement\Application\Services\SaleValidationService;
use SaleValidationManagement\Infrastructure\EventHandlers\SaleValidationEventHandler;
use SaleValidationManagement\Infrastructure\EventHandlers\StockVerificationEventHandler;
use SaleValidationManagement\Infrastructure\Interfaces\EventHandlers\SaleValidationEventHandlerInterface;
use SaleValidationManagement\Infrastructure\Interfaces\EventHandlers\StockVerificationEventHandlerInterface;
use SaleValidationManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;
use SaleValidationManagement\Infrastructure\Repositories\ProductRepository;

class SaleValidationServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(StockVerificationEventHandlerInterface::class, StockVerificationEventHandler::class);
        $this->app->bind(SaleValidationEventHandlerInterface::class, SaleValidationEventHandler::class);
        $this->app->bind(SaleValidationServiceInterface::class, SaleValidationService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
