<?php

namespace Modules\Napp\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmPayedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'polisUuid' => 'required|uuid',
            'paidAt' => 'required|date',
            'insurancePremium' => 'required|numeric|min:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'comission' => 'required|numeric|min:0',
            'agencyId' => 'nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validatsiya xatoligi',
            'status' => 422,
            'errors' => $validator->errors(),
        ], 422));
    }
}
