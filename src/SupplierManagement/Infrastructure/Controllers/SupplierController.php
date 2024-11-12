<?php

namespace SupplierManagement\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kernel\Infrastructure\Controllers\BaseController;
use SupplierManagement\Application\Interfaces\Services\SupplierServiceInterface;
use SupplierManagement\Application\Mappers\SupplierNewDtoMapper;
use SupplierManagement\Application\Mappers\SupplierUpdateDtoMapper;

class SupplierController extends BaseController
{
    /**
     * @var SupplierServiceInterface
     */
    private SupplierServiceInterface $supplierService;

    /**
     * @param SupplierServiceInterface $supplierService
     */
    public function __construct(SupplierServiceInterface $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'nit' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'string', 'email'],
            'phoneNumber' => ['required', 'string'],
        ]);

        return $this->execWithJsonResponse(function () use ($request) {
            $dto = (new SupplierNewDtoMapper())
                ->createFromRequest($request);

            $this->supplierService->store($dto);

            return [
                'message' => 'Proveedor creado exitosamente'
            ];
        });
    }

    /**
     * @param int $supplierId
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $supplierId, Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'nit' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'string', 'email'],
            'phoneNumber' => ['required', 'string'],
        ]);

        return $this->execWithJsonResponse(function () use ($supplierId, $request) {
            $dto = (new SupplierUpdateDtoMapper())
                ->createFromRequest($request);
            $dto->id = $supplierId;

            $this->supplierService->update($dto);

            return [
                'message' => 'Proveedor actualizado exitosamente'
            ];
        });
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return $this->execWithJsonResponse(function () {
            $data = $this->supplierService->getAll();

            return [
                'message' => 'Listado de proveedores',
                'data' => $data
            ];
        });
    }

    /**
     * @param int $supplierId
     * @return JsonResponse
     */
    public function findById(int $supplierId): JsonResponse
    {
        return $this->execWithJsonResponse(function () use ($supplierId) {
            $supplier = $this->supplierService->findById($supplierId);

            return [
                'message' => 'Proveedor encontrado',
                'data' => $supplier
            ];
        });
    }
}
