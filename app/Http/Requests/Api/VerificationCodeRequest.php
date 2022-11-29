<?php

namespace App\Http\Requests\Api;


use JetBrains\PhpStorm\ArrayShape;

class VerificationCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'captcha_key'  => 'required|string',
            'captcha_code' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'captcha_key'  => '图片验证码 key',
            'captcha_code' => '图片验证码',
        ];
    }

}
