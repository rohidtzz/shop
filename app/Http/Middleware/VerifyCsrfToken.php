<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'https://shop.hidtzz.my.id/callback',
        'http://shop.hidtzz.my.id/callback',
        'https://shop.hidtzz.my.id/callback/iak',
        'http://shop.hidtzz.my.id/callback/iak',

        'http://shop.hidtzz.my.id/cost',
        'https://shop.hidtzz.my.id/cost',
        'http://localhost:8000/cost',
        'https://fb01-175-158-42-101.ap.ngrok.io/callback',
        'https://localhost:8000/callback'
    ];
}
