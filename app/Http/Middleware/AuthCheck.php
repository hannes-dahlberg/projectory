<?php namespace App\Http\Middleware;

use Closure;
use Auth;

/*Working with passport tokens the only built in way to get the current logged in user
is when accessing protected routing (using auth:api middleware). A controller which is
not protected will give Auth::check() == false.

This middleware can be attached to controllers you want anyone to have access to but
still want to know if the user is logged in or not.

This middleware will never stop the current request, only attach the user to the Auth
model if a bearer token is present in the header*/
class AuthCheck {
    public function handle($request, Closure $next) {
        /*Check if user is not logged in and attach the current user to
        user in the request. Silly right? The user is actually authenticated
        in the request but for some reason never authenticated by the Auth
        model. Anyway if the user is not already logged in and exists
        in the request the user will be logged in*/
        if(!Auth::check() && $user = $request->user('api')) {
            Auth::login($user);
        }

        //Continue with request no matter what
        return $next($request);
    }
}