<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role == Constant::USER_SUPER_ADMIN_ROLE
                || Auth::user()->role == Constant::USER_ADMIN_ROLE
            ){
                return $next($request);
            }
            return redirect()->route('client.home');
        }else{
            return redirect()->route('client.home');
        }
    }
}
