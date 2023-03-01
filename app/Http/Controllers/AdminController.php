<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    //Admin Logour Method
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    //Admin Login Method
    public function AdminLogin()
    {
        return view('admin.Auth.Login');
    }
    //View_Profile Method
    public function viewprofile()
    {
        $id = Auth::user()->id;
        $admindata = User::findorFail($id);
        return view('admin.view_profile', compact('admindata'));
    }
}
