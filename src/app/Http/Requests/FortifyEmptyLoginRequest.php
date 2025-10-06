<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as BaseLoginRequest;

class FortifyEmptyLoginRequest extends BaseLoginRequest
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
