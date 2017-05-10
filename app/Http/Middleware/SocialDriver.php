<?php namespace App\Http\Middleware;

use Closure;

class SocialDriver {
    public function handle($request, Closure $next) {
        if(in_array($request->driver, ['facebook', 'linkedin', 'google', 'github'])) {
            return $next($request);
        }

        return redirect('/');
    }
}
