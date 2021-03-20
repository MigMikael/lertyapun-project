<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerActiveAuth
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
        $customer = Auth::guard($guard)->user();
        if ($customer->status == 'pending') {
            return redirect('customer/pending/'.$customer->slug);
        } else if ($customer->status == 'suspend') {
            return "user is suspend"; // Todo Handle this
        } else if ($customer->status == 'inactive') {
            return redirect('customer/password/'.$customer->slug.'/reset');
        }
        // Todo Inactive handle
        return $next($request);
    }
}
