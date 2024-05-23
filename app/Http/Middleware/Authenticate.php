<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    protected $guards = [];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
        if (! $request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin') {
                return route('admin.login');
            }
            elseif (Arr::first($this->guards) === 'employee') {
                return route('employee.login');
            }
            
            return route('home');
        }
    }
}
