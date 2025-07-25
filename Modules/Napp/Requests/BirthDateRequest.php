<?php

namespace Modules\Napp\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BirthDateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document' => 'required|string',
            'birthDate' => 'required|string',
            'isConsent' => 'nullable|string',
            'senderPinfl' => 'nullable|integer',
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
