<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {

            // JIKA SISWA
            if ($request->is('siswa/*') || $request->routeIs('siswa.*')) {
                return route('siswa.login');
            }

            // DEFAULT (ADMIN / PETUGAS)
            return route('login');
        }

        return null;
    }
}
