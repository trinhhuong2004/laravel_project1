<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // Redirect to a specific page if the user does not have the required role
            return redirect('/unauthorized');
        }

        return $next($request);
    }
}
