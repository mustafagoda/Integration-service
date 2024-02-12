<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SwitchTenant
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        switch_db_connection_by_identifier();
        return $next($request);
    }
}
