<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use const http\Client\Curl\AUTH_ANY;

class VerifyIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (User::isAdmin() === true)
        {
            return $next($request);
        } else {
<<<<<<< HEAD
            return redirect('/home');
=======
            return redirect('/home');
>>>>>>> origin/main
        }


    }
}
