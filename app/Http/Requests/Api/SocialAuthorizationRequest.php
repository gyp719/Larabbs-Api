<?php

namespace App\Http\Requests\Api;


class SocialAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
        ];

        if ($this->input('social_type') == 'wechat' && !$this->input('code')) {
            $rules['openid']  = 'required|string';
        }

        return $rules;
    }
}
