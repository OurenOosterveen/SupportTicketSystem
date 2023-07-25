<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoggedInUserResource;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    private const COOKIE_NAME = 'Authorization';

    private JWTGuard $guard;

    /**
     * Construct a new controller
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function login(LoginRequest $loginRequest)
    {
        $validated = $loginRequest->validated();

        $token = $this->guard->attempt(['email' => $validated['email'], 'password' => $validated['password']]);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $this->guard->userOrFail();

        $responseData = [
            'status' => 'success',
            'user' => new LoggedInUserResource($user),
        ];

        $secureCookie = config('app.env') === 'production';

        return (new JsonResponse($responseData, Response::HTTP_OK))
            ->cookie(self::COOKIE_NAME, "Bearer {$token}", 60 * 24 * 30, '/', '', $secureCookie, true);
    }
}