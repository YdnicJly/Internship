<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  string|array  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Jika belum login
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Jika role user tidak sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
