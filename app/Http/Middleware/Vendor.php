<?php

namespace App\Http\Middleware;

use Closure;

class Vendor
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
        if(Auth::user()->isVendor()){
            return $next($request);
        }else{
            Session::flash('warning' , 'Доступ запрещен!');
            return redirect()->back();
        }

    }
}
