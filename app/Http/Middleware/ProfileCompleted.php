<?php

namespace App\Http\Middleware;

use Closure;

class ProfileCompleted
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
        $user  = $request->user();
        if ($user->hasRole('Brand')) {
            if (is_null($user->name) or is_null($user->brand_name)) {
                return redirect('brand-complete-profile');
            }
        }
        if ($user->hasRole('Influencer')) {
            if ($user->profile_completed == false) {
                return redirect('connect-facebook');
            }
        }
        return $next($request);
    }
}
