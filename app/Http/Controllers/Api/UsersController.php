<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = Cache::get($request->input('verification_key'));

        if (!$verifyData) {
            abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->input('verification_code'))) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name'     => $request->input('name'),
            'phone'    => $verifyData['phone'],
            'password' => $request->input('password'),
        ]);

        // 清除验证码缓存
        Cache::forget($request->input('verification_key'));

        return new UserResource($user);
    }
}
