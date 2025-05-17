<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle(Request $request, Closure $next)
    {
        // Si la solicitud es un tipo que necesita protección CSRF (POST, PUT, PATCH, DELETE)
        if ($this->isReading($request) || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        // Verifica si el token de CSRF es válido
        if ($this->tokensMatch($request)) {
            return $next($request);
        }

        // Si los tokens no coinciden, lanza la excepción
        throw new TokenMismatchException;
    }

    /**
     * Determina si la solicitud es de lectura.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading(Request $request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }

    /**
     * Determina si la solicitud debe omitir la verificación de CSRF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldPassThrough(Request $request)
    {
        $except = $this->except();

        foreach ($except as $url) {
            if ($request->is($url)) {
                return true;
            }
        }

        return false;
    }

    /**
     * La URL que debe excluirse de la verificación de CSRF.
     *
     * @return array
     */
    protected function except()
    {
        return [];
    }

    /**
     * Verifica si el token de CSRF es válido.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch(Request $request)
    {
        // Usa el helper de Laravel para comparar el token CSRF
        return $request->session()->token() === $request->input('_token');
    }
}
