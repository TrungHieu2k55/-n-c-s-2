<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('login.signin');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'mat_khau' => 'required',
        ]);

        $email = $request->input('email');
        $passwordToCheck = $request->input('mat_khau');

        $error_message = 'Thông tin đăng nhập không chính xác.'; // Default error message

        // Check if the user is an employee (User)
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($passwordToCheck, $user->mat_khau)) {
                Auth::login($user);
                session()->push('flash_notification', [
                    'type' => 'info',
                    'message' => 'Welcome to admin',
                    'title' => 'Đăng nhập'
                ]);
                return redirect()->route('index'); // Redirect to 'index' route

            } else {
                $error_message = 'Mật khẩu không chính xác cho tài khoản nhân viên.';
            }
        } else {
            // Check if the user is a customer (Customer)
            $customer = Customer::where('email', $email)->first();

            if ($customer) {
                if (Hash::check($passwordToCheck, $customer->mat_khau)) {
                    Auth::guard('customers')->login($customer); // Sử dụng đúng guard
                    session(['ma_khach_hang' => $customer->ma_khach_hang]);
                    session(['ten_khach_hang' => $customer->ten_khach_hang]);
                    session()->push('flash_notification', [
                        'type' => 'info',
                        'message' => 'Welcome to customer',
                        'title' => 'Đăng nhập'
                    ]);
                    return redirect()->route('maininterface');
                } else {
                    $error_message = 'Mật khẩu không chính xác cho tài khoản khách hàng.';
                }
            } else {

                $error_message = 'Email không tồn tại.';
            }
        }
        // Gửi thông báo thành công
        session()->push('flash_notification', [
            'type' => 'error',
            'message' => 'Email không tồn tại.',
            'title' => 'Thông báo'
        ]);
        // If login fails, redirect back to login with detailed error message
        return redirect()->route('login')->withErrors([
            'email' => $error_message,
        ]);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function logoutcus()
    {
        Session::forget('ma_khach_hang'); // Xóa session ma_khach_hang
        Session::forget('ten_khach_hang'); // Xóa session ten_khach_hang

        Auth::guard('customers')->logout(); // Đăng xuất người dùng
        return redirect('/customer/maininterface/{luot_xem?}/{ma_loai?}');
    }
}
