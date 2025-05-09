<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log request body atau informasi yang diperlukan
        $log = "[" . now() . "] "
            . $request->method() . " "
            . $request->fullUrl() . " "
            . json_encode($request->all()) . "\n";

        File::append(storage_path('logs/log.txt'), $log);

        return $next($request);
    }
}
