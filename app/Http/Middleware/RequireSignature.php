<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireSignature
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->signature && !$request->routeIs('profile.*')) {
            return redirect()->route('profile.show')
                ->with('warning', 'กรุณาตั้งค่าลายเซ็นของคุณก่อนใช้งานระบบ');
        }

        return $next($request);
    }
}
