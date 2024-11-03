<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function handlogin(Request $rqt)
    {

        $rqt->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($user = User::where("Email", $rqt->email)->first()) {
            // dd($user);
            if (Hash::check($rqt->password, $user->Pw)) {
                Auth::login($user);
                return redirect()->route("index");
            } else {
                return redirect()->route("register")->with('error', 'Mật khẩu không đúng');
                // return back()->with('error', 'Mã sinh viên hoặc mật khẩu không đúng');
            }
        }
        return redirect()->route("register")->with('error', 'Email không đúng');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function  handleLogout()
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->route('index'); // Chuyển hướng về trang đăng nhập hoặc trang khác
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
