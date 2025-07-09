<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * Register a new user.
     *
     * @param RegisterAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterAuthRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']); // Hash the password
        User::create($validated);
        return response()->json([
            'status' => 201,
            'message' => 'Usuario creado correctamente.',
        ], 201);
    }

    /**
     * Login a user and return a JWT token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'message' => 'Credenciales inválidas.',
            ], 401);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Inicio de sesión exitoso.',
            'token' => $token,
        ]);
    }

    /**
     * Logout the user and invalidate the JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'status' => 200,
            'message' => 'Sesión cerrada exitosamente.',
        ]);
    }

    /**
     * Refresh the JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json([
                'status' => 200,
                'message' => 'Token actualizado exitosamente.',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 401,
                'message' => 'Token inválido o expirado.',
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            $user = JWTAuth::user();
            return response()->json([
                'status' => 200,
                'message' => 'Usuario autenticado correctamente.',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 401,
                'message' => 'Token inválido o expirado.',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
