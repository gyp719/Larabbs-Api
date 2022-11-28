<?php

namespace App\Http\Requests\Api;


use JetBrains\PhpStorm\ArrayShape;

class VerificationCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|phone:CN,mobile|unique:users',
        ];
    }

}
