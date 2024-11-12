<?php

namespace ProductManagement\Infrastructure\Controllers;

use App\Events\ProductUpdated;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kernel\Infrastructure\Controllers\BaseController;
use ProductManagement\Application\Interfaces\Services\ProductServiceInterface;
use ProductManagement\Application\Mappers\ProductNewDtoMapper;
use ProductManagement\Application\Mappers\ProductUpdateDtoMapper;

class ProductController extends BaseController
{
    /**
     * @var ProductServiceInterface
     */
    private ProductServiceInterface $productService;

    /**
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'supplierId' => ['required', 'integer', 'exists:suppliers,id'],
            'name' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        return $this->execWithJsonResponse(function () use ($request) {
            $dto = (new ProductNewDtoMapper())
                ->createFromRequest($request);

            $this->productService
                ->store($dto);

            return [
                'message' => 'Producto creado exitosamente'
            ];
        });
    }

    /**
     * @param int $productId
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $productId, Request $request): JsonResponse
    {
        $request->validate([
            'supplierId' => ['required', 'integer', 'exists:suppliers,id'],
            'name' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'active' => ['required', 'boolean'],
        ]);

        return $this->execWithJsonResponse(function () use ($productId, $request) {
            $dto = (new ProductUpdateDtoMapper())
                ->createFromRequest($request);
            $dto->id = $productId;

            $this->productService
                ->update($dto);

            return [
                'message' => 'Producto actualizado exitosamente'
            ];
        });
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return $this->execWithJsonResponse(function () {
            $data = $this->productService
                ->getAll();

            return [
                'message' => 'Listado de productos',
                'data' => $data
            ];
        });
    }

    /**
     * @param int $productId
     * @return JsonResponse
     */
    public function findById(int $productId): JsonResponse
    {
        return $this->execWithJsonResponse(function () use ($productId) {
            $product = $this->productService
                ->findById($productId);

            return [
                'message' => 'Listado de productos',
                'data' => $product
            ];
        });
    }
}
