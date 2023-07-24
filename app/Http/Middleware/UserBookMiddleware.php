<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserBookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $book = $request->book;

        if ($request->user()->hasRole('admin')) {
            return $next($request);
        }

        if(!$request->user()->books->contains($book)) {
            abort(403, "Unauthorized action.");
        }

        return $next($request);
    }
}
