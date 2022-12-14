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
        'http://shop.hidtzz.my.id/cost',
        'https://shop.hidtzz.my.id/cost',
        'http://localhost:8000/cost',
    ];
}
