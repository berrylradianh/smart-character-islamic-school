<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$request->routeIs('profile.edit') && !$request->routeIs('profile.update')) {
            if ($user->role && in_array($user->role->name, ['Admin', 'Superadmin'])) {
                return $next($request);
            }

            if (!$user->isProfileComplete()) {
                return redirect()->route('profile.edit')
                    ->with('warning', 'Profil Anda belum lengkap. Silakan lengkapi profil untuk melanjutkan.');
            }
        }

        return $next($request);
    }
}
