<?php

namespace Modules\Napp\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class BirthDateRepository
{
    protected string $erspToken;

    public function __construct()
    {
        $this->erspToken = env('SERVICE_ERSP_TOKEN');
    }

    public function fetch(array $data)
    {
        $transactionId = Carbon::now()->valueOf();

        $payload = [
            'transactionId' => $transactionId,
            'isConsent' => $data['isConsent'] ?? "Y",
            'senderPinfl' => $data['senderPinfl'] ?? 51308045700043,
            'document' => $data['document'],
            'birthDate' => $data['birthDate'],
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer {$this->erspToken}",
        ])->post('https://erspapi.e-osgo.uz/api/provider/passport-birth-date-v2', $payload);

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
