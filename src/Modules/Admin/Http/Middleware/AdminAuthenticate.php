<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Admin\Transformers\FailResource;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();

        if (!$bearerToken) {
            return FailResource::make()->setMetaCode(402)->setMetaMessage('Token not found');
        }

//        dd($request->expectsJson());
//        if (!$request->expectsJson()) {
//            throw ApiException::forbidden('token_invalid');
//        }

        return $next($request);
    }
}
