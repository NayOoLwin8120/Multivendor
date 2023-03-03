<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    }
    //Vendor Logout Method
    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    public function VendorLogin()
    {
        return view('vendor.Auth.Login');
    }
    //View_Profile Method
    public function viewprofile()
    {
        $id = Auth::user()->id;
        $vendor = User::findorFail($id);
        return view('vendor.view_profile', compact('vendor'));
    }
    //store profile method
    public function VendorProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('adminbackend/upload/vendor_profile/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('adminbackend/upload/vendor_profile/'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(

            'message' => "Profile Updated Successfully",
            "alert-type" => 'success'


        );

        return redirect()->back()->with($notification);
    }
    public function VendorChangePassword()
    {
        return view('vendor.ChangePassword');
    }
    public function Storepassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }
        if ($request->new_password != $request->new_password_confirmation) {
            return back()->with("error", "New Password and Confirm Password don't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");
    }
}
