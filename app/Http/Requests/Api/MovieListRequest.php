<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MovieListRequest extends FormRequest
{
    /**
     * the validation rules that apply to the request (student6).
     */
    public function rules()
    {
        return [
            'genre' => 'sometimes|string',
            'limit' => 'sometimes|integer|min:0',
            'offset' => 'sometimes|integer|min:0',
        ];
    }
}
