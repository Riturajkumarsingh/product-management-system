<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user and return an API token.
     *
     * POST /api/register
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->generateApiToken();

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
            'data'    => [
                'user'  => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
                'token' => $token,
            ],
        ], 201);
    }

    /**
     * Authenticate user and return an API Bearer token.
     *
     * POST /api/login
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->generateApiToken();

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data'    => [
                'user'  => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
                'token' => $token,
            ],
        ]);
    }

    /**
     * Revoke the current user's API token (logout).
     *
     * POST /api/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->update(['api_token' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
            'data'    => null,
        ]);
    }
}
