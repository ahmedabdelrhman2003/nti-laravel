<?php

namespace App\Http\Middleware;

use App\Http\traits\ApiTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserVerified
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('sanctum')->user();
        if (is_null($auth && is_null($request->email_verified_at))) {
            return $this->ErrorMessage([], 'unauthrized');
        } else {
            return $next($request);
        }
    }
}
