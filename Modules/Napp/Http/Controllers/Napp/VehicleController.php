<?php

namespace Modules\Napp\Http\Controllers\Napp;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Napp\Repositories\VehicleRepository;
use Modules\Napp\Requests\VehicleRequest;

class VehicleController extends Controller
{

    protected VehicleRepository $repository;
    public function __construct(VehicleRepository $repository)
    {
        $this->repository = $repository;
    }
    public function vehicle(VehicleRequest $request)
    {
        try {
            $response = $this->repository->fetch($request->validated());
            if ($response instanceof JsonResponse) {
                return $response;
            }
            return response()->json([
                'success' => true,
                'data' => $response->json(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ichki xatolik yuz berdi',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
