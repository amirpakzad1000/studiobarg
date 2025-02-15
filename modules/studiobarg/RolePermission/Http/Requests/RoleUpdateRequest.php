<?php

namespace studiobarg\RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // بررسی احراز هویت کاربر
    }

    public function rules(): array
    {
        return [
            "id"          => "required|exists:roles,id",
            "name"        => "required|string|min:3|max:255|unique:roles,name," . request()->id,
            "permissions" => "required|array|min:1",
            "permissions.*" => "exists:permissions,name", // بررسی معتبر بودن هر مجوز
        ];
    }
}
