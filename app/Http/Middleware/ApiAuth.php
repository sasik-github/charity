<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 9:31 PM
 */

namespace App\Http\Middleware;


use Auth;

class ApiAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        return Auth::onceBasic('telephone') ?: $next($request);
    }
}
