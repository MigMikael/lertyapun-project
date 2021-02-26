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
        if ($customer->status == 'pending' or $customer->status == 'suspend' or $customer->status == 'inactive') {
            return redirect('customer/pending/'.$customer->slug);
        }
        // Todo Inactive handle
        return $next($request);
    }
}
