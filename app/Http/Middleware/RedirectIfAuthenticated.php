<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (auth($guard)->check()) {
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                $user = auth($guard)->user();
                if ($user && method_exists($user, 'isVendor') && $user->isVendor()) {
                    return redirect()->route('vendor.dashboard');
                }

                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
