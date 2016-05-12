<?php
/**
 * User: sasik
 * Date: 4/15/16
 * Time: 9:12 AM
 */

namespace App\Http\Middleware;


use Closure;

class Admin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = \Auth::user();

        if (
            $user
            && !\Auth::user()->isAdmin()
        ){
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}