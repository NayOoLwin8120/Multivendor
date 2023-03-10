<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.brand_all', compact('brands'));
    } // End Method

    public function AddBrand()
    {
        return view('admin.brand.brand_add');
    } // End Method
    public function StoreBrand(Request $request)
    {
        $image = $request->file('brand_image');
        $image_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('adminbackend/upload/brand/' . $image_gen);
        $save_url = 'adminbackend/upload/brand/' . $image_gen;
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace("", "-", $request->brand_name)),
            'brand_image' => $save_url,
        ]);
        $notification = array([
            'message' => 'Successfully added new brand',
            'alert-type' => 'success',
        ]);
        return redirect()->route('all.brand')->with($notification);
    }
    public function EditBrand($id)
    {
        $brand = Brand::findorFail($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }
    public function UpdateBrand(Request $request)
    {

        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('adminbackend/upload/brand/' . $name_gen);
            $save_url = 'adminbackend/upload/brand/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        } else {

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        } // end else

    } // End Method

    public function DeleteBrand($id)
    {
        $brand = Brand::findorFail($id);


        // if ($brand->brand_image == ""  || isset($brand->brand_image)) {
        //     // @dd($brand->brand_image);
        //     unlink($brand->brand_image);
        // }


        Brand::findorFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
