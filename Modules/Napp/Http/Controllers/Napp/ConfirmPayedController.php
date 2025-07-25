<?php

namespace Modules\Napp\Http\Controllers\Napp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Napp\Repositories\ConfirmPayedRepository;
use Modules\Napp\Requests\ConfirmPayedRequest;use Illuminate\Http\JsonResponse;


class ConfirmPayedController extends Controller
{
    protected ConfirmPayedRepository $repository;
    public function __construct(ConfirmPayedRepository $repository)
    {
        $this->repository = $repository;
    }
    public function confirmPayed(ConfirmPayedRequest $request)
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
