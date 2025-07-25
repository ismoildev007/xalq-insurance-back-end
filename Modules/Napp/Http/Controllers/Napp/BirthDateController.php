<?php

namespace Modules\Napp\Http\Controllers\Napp;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Napp\Repositories\BirthDateRepository;
use Modules\Napp\Requests\BirthDateRequest;

class BirthDateController extends Controller
{
    protected BirthDateRepository $repository;
    public function __construct(BirthDateRepository $repository)
    {
        $this->repository = $repository;
    }
    public function erspBirthDate(BirthDateRequest $request)
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
