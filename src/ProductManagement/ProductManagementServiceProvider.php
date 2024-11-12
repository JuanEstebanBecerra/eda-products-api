<?php

namespace ProductManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProductManagement\Application\Interfaces\Services\ProductServiceInterface;
use ProductManagement\Application\Services\ProductService;
use ProductManagement\Infrastructure\Interfaces\Repositories\ProductRepositoryInterface;
use ProductManagement\Infrastructure\Repositories\ProductRepository;

class ProductManagementServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
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
        Route::prefix('api/product_management')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/Infrastructure/Routes/api.php');
            });
    }
}
