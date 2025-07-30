<?php

namespace Modules\Napp\Repositories;

use Illuminate\Support\Facades\Http;

class VehicleRepository
{
    public function handle() {}

    protected string $erspToken;

    public function __construct()
    {
        $this->erspToken = env('SERVICE_ERSP_TOKEN');
    }
    public function fetch(array $data)
    {
        $info = [
            'techPassportSeria' => $data['techPassportSeria'],
            'techPassportNumber' => $data['techPassportNumber'],
            'govNumber' => $data['govNumber'],
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer {$this->erspToken}",
        ])->post('https://erspapi.e-osgo.uz/api/provider/vehicle', $info);

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Tashqi API so‘rovda xatolik',
                'status' => $response->status(),
                'errors' => $response->json(), // bu API'dan kelgan xatoliklar
            ], $response->status() === 200 ? 422 : $response->status());
        }

        return $response;
    }
}
