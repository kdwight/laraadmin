<?php

namespace App\Http\Middleware;

use Closure;

class PageAccess
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
        if (in_array("pages", json_decode(auth()->user()->hasAccess()->access))) {
            return $next($request);
        }

        return abort(403);
    }
}
