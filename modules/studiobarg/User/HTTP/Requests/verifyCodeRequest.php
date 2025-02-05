<?php

namespace studiobarg\User\HTTP\Requests;

use Illuminate\Foundation\Http\FormRequest;
use studiobarg\User\Services\VerifyCodeService;

class verifyCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'verify_code' => VerifyCodeService::getRule()
        ];
    }
}
