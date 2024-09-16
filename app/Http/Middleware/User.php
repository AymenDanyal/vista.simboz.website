<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        
        if (!auth()->check()) {
            
            if ($request->ajax()) {
                return response()->json(['auth' => false, 'redirect_url' => route('home')], 401);
            }
            session()->flash('auth_failed', true);
            return redirect('/');
        }
        else{
            return $next($request);
        }
    }
}
