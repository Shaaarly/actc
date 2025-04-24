<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromptTwoFactorSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (
            auth()->check() &&
            !auth()->user()->two_factor_secret &&
            !session()->has('2fa_prompted')
        ) {
            session()->flash('show_2fa_modal', true);
            session()->put('2fa_prompted', true);
        }

        return $next($request);
    }
}
