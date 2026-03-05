<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowIframeEmbedding
{
    /**
     * Permite que la respuesta se muestre en un iframe del mismo origen.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->remove('Content-Security-Policy');

        return $response;
    }
}
