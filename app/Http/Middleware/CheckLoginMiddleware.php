<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        //  Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Kiểm tra vai trò của người dùng
            if (Auth::user()->ma_vai_tro == $role) {
                return $next($request);
            } else {
                abort(403, 'Bạn không có quyền truy cập.');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
