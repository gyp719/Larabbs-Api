<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $captchaCacheKey = $request->input('captcha_key');
        $captchaData     = Cache::get($captchaCacheKey);

        if (!$captchaData) {
            abort(403, '图片验证码已失效');
        }

        if (!hash_equals(strtolower($captchaData['code']), strtolower($request->input('captcha_code')))) {
            // 验证错误就清除缓存
            Cache::forget($captchaCacheKey);
            throw new AuthenticationException('验证码错误');
        }

        $phone = $captchaData['phone'];

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            try {
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data'     => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }

        $cacheKey  = 'verificationCode_' . Str::random(15);
        $expiredAt = now()->addMinutes(5);
        // 缓存验证码 5 分钟过期。
        Cache::put($cacheKey, ['phone' => $phone, 'code' => $code], $expiredAt);
        // 清除图片验证码缓存
        Cache::forget($captchaCacheKey);

        return response()->json([
            'key'        => $cacheKey,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
