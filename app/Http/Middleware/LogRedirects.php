<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->isRedirection()) {
            // Captura el stack trace completo
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10); // Limita a 10 niveles
            
            // Busca la primera entrada fuera del núcleo de Laravel
            foreach ($trace as $frame) {
                if (!str_contains($frame['file'] ?? '', '/vendor/laravel/framework/')) {
                    Log::info('Redirección detectada', [
                        'desde' => $request->fullUrl(),
                        'hacia' => $response->headers->get('Location'),
                        'archivo' => $frame['file'] ?? 'N/A',
                        'línea' => $frame['line'] ?? 'N/A',
                        'función' => $frame['function'] ?? 'N/A',
                    ]);
                    break;
                }
            }
        }

        return $response;
    }
}
