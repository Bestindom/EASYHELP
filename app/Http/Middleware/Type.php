<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Type
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
        $user = auth()->user();

        foreach($types as $type) {
            if($user->type_id == $type)
                return $next($request);
        }

        return redirect('map');
    }
}