<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class isAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->token ?: $request->bearerToken();
        $user = User::where(['token' => $token, 'token_state' => 'on'])->first();
        if($user) return $next($request);

        return response()->json(['message' => 'Acceso no autorizado'], 401);
    }
}
