<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login'); 
        }

        if (auth()->user()->role !== $role) {
            if (auth()->user()->role === 'user' && $role === 'admin') {
                return redirect()->route('warga.beranda')->with('error', 'Akses ditolak');
            }
            if (auth()->user()->role === 'admin' && $role === 'user') {
                return redirect()->route('admin.beranda')->with('error', 'Akses ditolak');
            }
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
