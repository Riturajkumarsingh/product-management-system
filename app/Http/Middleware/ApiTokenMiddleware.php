<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     * Authenticates API requests using the Bearer token stored in users.api_token.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Please provide a Bearer token.',
                'errors'  => null,
            ], 401);
        }

        $user = User::where('api_token', $token)->first();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired token.',
                'errors'  => null,
            ], 401);
        }

        // Bind the authenticated user to the request
        auth()->setUser($user);

        return $next($request);
    }
}
