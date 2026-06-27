<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // $roles akan berisi ['admin'] dari 'admin:admin' di web.php
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Jika user bukan admin, tendang ke home
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}
