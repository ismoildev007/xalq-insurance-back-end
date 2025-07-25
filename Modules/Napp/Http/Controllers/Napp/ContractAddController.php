<?php

namespace Modules\Napp\Http\Controllers\Napp;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Napp\Repositories\ContractAddRepository;
use Modules\Napp\Requests\ContractAddRequest;

class ContractAddController extends Controller
{
    protected ContractAddRepository $repository;
    public function __construct(ContractAddRepository $repository)
    {
        $this->repository = $repository;
    }
    public function contractAdd(Request $request)
    {
        try {
            $response = $this->repository->fetch($request->all());

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
