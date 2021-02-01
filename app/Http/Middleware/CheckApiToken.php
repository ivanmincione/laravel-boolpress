<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) // all'interno del metodo "handle" va inserita tutta la logica riguardante il middleware
    {
        return $next($request);
    }
}
