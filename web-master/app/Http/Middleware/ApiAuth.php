<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class ApiAuth
{
    /**
     * @var JWTAuth
     */
    private $auth;

    public function __construct(JWTAuth $auth)
    {

        $this->auth = $auth;
    }

    public function getToken(Request $request)
    {
        if ($token = $request->bearerToken()) {
            return $token;
        }

        return $request->get('token');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        try {
            $authed = $this->auth->authenticate($this->getToken($request));
        } catch (JWTException $exception) {
            throw new AuthenticationException();
        }

        if (!$authed) throw new AuthenticationException();

        return $next($request);
    }
}
