<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\LoggedInUserResource;
use App\Http\Responses\NoContentResponse;
use App\Mail\PasswordResetMail;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            return new JsonResponse(
                ['errors' => ['credentials' => 'E-mail of wachtwoord is onjuist']],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
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

    /**
     * Log the user out (Invalidate the token). And delete the Authorization cookie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->guard->logout();

        return (new JsonResponse)->cookie(self::COOKIE_NAME);
    }

    public function forgotPassword(ForgotPasswordRequest $request): NoContentResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();
        
        if (!$user) {
            return new NoContentResponse;
        }

        $token = (new PasswordReset)->create($user);

        Mail::to($user->email)->queue(new PasswordResetMail($user, $token));
        
        return new NoContentResponse;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();
        
        if (!$user) {
            return new NoContentResponse;
        }
        
        $user->password = bcrypt($validated['password']);
        $user->save();

        PasswordReset::where('email', $user->email)->delete();

        return new NoContentResponse;
    }
}
