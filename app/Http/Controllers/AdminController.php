<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    //Admin Logout Method
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
        $adminData = User::findorFail($id);
        return view('admin.view_profile', compact('adminData'));
    }

    //store profile method
    public function AdminProfileStore(Request $request)
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
            @unlink(public_path('adminbackend/upload/admin_profile/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('adminbackend/upload/admin_profile/'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(

            'message' => "Profile Updated Successfully",
            "alert-type" => 'success'


        );

        return redirect()->back()->with($notification);
    }
    //Change Password Method
    public function AdminChangePassword()
    {
        return view('admin.ChangePassword');
    }
    public function StorePassword(Request $request)
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
    public function InactiveVendor()
    {
        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('admin.vendor.inactive_vendor', compact('inActiveVendor'));
    } // End Mehtod
    public function ActiveVendor()
    {
        $ActiveVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('admin.vendor.active_vendor', compact('ActiveVendor'));
    } // End Mehtod

    public function InActiveVendorDetails($id)
    {
        $inactive_vendor_details = User::findorFail($id);
        return view('admin.vendor.inactive_vendor_details', compact('inactive_vendor_details'));
    } // End Mehtod

    public function ActiveVendorApprove(Request $request)
    {

        $verdor_id = $request->id;
        User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendor')->with($notification);
    } // End Mehtod


    public function  ActiveVendorDetails($id)
    {
        $active_vendor_details = User::findorFail($id);
        return view('admin.vendor.active_vendor_details', compact('active_vendor_details'));
    } // End Mehtod

    public function InActiveVendorApprove(Request $request)
    {

        $verdor_id = $request->id;
        User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor InActive Status Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);
    } // End Mehtod
}
