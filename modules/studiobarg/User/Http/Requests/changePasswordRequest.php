<?php

namespace studiobarg\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use studiobarg\User\Rules\validPassword;
use studiobarg\User\Services\VerifyCodeService;

class changePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check()===true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ["required",new validPassword(),'confirmed'],
        ];
    }
}
