<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'customer')
    {
        // ตรวจจับทุก request ที่มีคำว่า 'image' ใน URL ไม่ว่าจะส่งมา format ไหน
        if (
            str_contains($request->getRequestUri(), 'image') ||
            str_contains($request->path(), 'image') ||
            $request->is('*image*')
        ) {
            return $next($request);
        }

        if (!Auth::guard($guard)->check() && !Auth::guard('admin')->check()) {
            return redirect('login');
        }

        return $next($request);
    }
}
