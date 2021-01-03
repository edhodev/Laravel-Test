<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\User;

class RoleMiddleware
{
    public $routeFinance = [
        'income',
        'income.data',
        'income.show',
        'income.create',
        'income.store',
        'income.update',
        'income.delete',
        'expense',
        'expense.data',
        'expense.show',
        'expense.create',
        'expense.store',
        'expense.update',
        'expense.delete',
        'profile',
        'profile.update',
    ];

    public $routeEditor = [
        'blog',
        'blog.data',
        'blog.show',
        'blog.create',
        'blog.store',
        'blog.update',
        'blog.delete',
    ];
    public function handle(Request $request, Closure $next)
    {
        $user = User::profile();
        if($user->role == "Finance") {
            if(!in_array(\Route::currentRouteName(),$this->routeFinance)) {
                return redirect()->route('income');
            }
        }
        if($user->role == "Editor") {
            if(!in_array(\Route::currentRouteName(),$this->routeEditor)) {
                return redirect()->route('blog');
            }
        }
        return $next($request);
    }
}
