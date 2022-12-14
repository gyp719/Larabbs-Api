<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChangeLocale
{
    public function handle(Request $request, Closure $next)
    {

        $language = $request->header('accept-language');
        if ($language) {
            App::setLocale($language);
        }

        return $next($request);
    }
}
