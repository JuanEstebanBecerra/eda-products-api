<?php

namespace SupplierManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SupplierManagement\Application\Interfaces\Services\SupplierServiceInterface;
use SupplierManagement\Application\Services\SupplierService;
use SupplierManagement\Infrastructure\Interfaces\Repositories\SupplierRepositoryInterface;
use SupplierManagement\Infrastructure\Repositories\SupplierRepository;

class SupplierManagementServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SupplierServiceInterface::class, SupplierService::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutes();
    }

    /**
     * @return void
     */
    public function loadRoutes(): void
    {
        Route::prefix('api/supplier_management')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/Infrastructure/Routes/api.php');
            });
    }
}
