<?php

namespace Modules\Napp\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class ConfirmPayedRepository
{
    protected string $erspToken;

    public function __construct()
    {
        $this->erspToken = env('SERVICE_ERSP_TOKEN');
    }

    public function fetch(array $data)
    {

        $payload = [
            'polisUuid' => $data['polisUuid'],
            'paidAt' => $data['paidAt'],
            'insurancePremium' => $data['insurancePremium'],
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'comission' => $data['comission'],
            'agencyId~' => 221, // kafilniki
        ];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer {$this->erspToken}",
        ])->post('https://erspapi.e-osgo.uz/api/v3/confirm-payed', $payload);

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Tashqi API so‘rovda xatolik',
                'status' => $response->status(),
                'errors' => $response->json(),
            ], $response->status() === 200 ? 422 : $response->status());
        }

        return $response;
    }
}
