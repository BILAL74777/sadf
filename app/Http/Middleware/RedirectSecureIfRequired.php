<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectSecureIfRequired
{
    /**
     * Used to redirect to secure site if in production mode
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('app.env') == 'production') {
        
            \Request::setTrustedProxies([$request->getClientIp()], Request::HEADER_X_FORWARDED_ALL);

            if (!$request->isSecure()) {
                return redirect()->secure($request->getRequestUri());
            }
        }
        

        return $next($request);
    }
}
