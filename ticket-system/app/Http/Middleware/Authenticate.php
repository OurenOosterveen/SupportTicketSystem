<?php

namespace App\Http\Middleware;


use Closure;
use Exception;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class Authenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($cookie = $request->cookie('Authorization')) {
            $request->headers->set('Authorization', $cookie);
        }

        try {
            $this->auth->parseToken()->authenticate();
        } catch (Exception $e) {
            $status = 'Authorization Token niet gevonden';
            if ($e instanceof TokenInvalidException) {
                $status = 'Authorization Token is niet geldig';
            } elseif ($e instanceof TokenExpiredException) {
                $status = 'Authorization Token is verlopen';
            }
            return response()->json(['message' => $status], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
