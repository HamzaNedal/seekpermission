<?php

namespace App\Http\Middleware;

use Closure;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        // dd(auth('employee')->user()->id);
        if (!auth()->guard("employee")->check()) {

            return redirect()->route('employee.login');
  
          }
          return $next($request);
    }
}
