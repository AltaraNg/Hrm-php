<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * This middleware forces all api response to be json
 */
class JsonMiddleware
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
        if ($request->route() !== null && in_array('api', $request->route()->middleware())) {
            $request->headers->set('Accept', 'application/vnd.api+json');
        }
        return $next($request);
    }
}
