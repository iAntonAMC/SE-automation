<?php

namespace App\Http\Middleware;

use Closure;

class CORSMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    $headers = [
        'Access-Control-Allow-Origin'      => 'http://localhost:666',
        'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age'           => '86400',
        'Access-Control-Allow-Headers'     => 'Accept, Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN',
        'Allow'                            => 'POST, GET, OPTIONS, PUT, DELETE',
        'Accept'                           => '*/*',
        'Content-type'                     => 'application/json'
    ];

    if ($request->isMethod('OPTIONS'))
    {
        return response()->json('{"method":"OPTIONS"}', 200, $headers);
    }

    $response = $next($request);

    foreach($headers as $key => $value)
    {
        $response->header($key, $value);
    }

    return $response;
    }
}
