<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class ApiKeyMiddleware
{
    /**
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $key = $request->header('Authorization');
        if(!$key || $key !== config('app.api_key')) {
            throw new AuthenticationException('Wrong api key');
        }

        return $next($request);
    }
}
