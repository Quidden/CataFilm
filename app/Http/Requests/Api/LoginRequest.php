<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['bail', 'required', 'email', 'string', 'max:255'],
            'password' => ['bail', 'required', 'string',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 72) {
                        $fail('The password must be between 8 and 72 characters.');
                    }
                }],
        ];
    }
}
