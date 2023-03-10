<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::latest()->get();
        return view('admin.category.all_category', compact('category'));
    } // End Method

    public function AddCategory()
    {
        return view('admin.category.category_add');
    } // End Method
    public function StoreCategory(Request $request)
    {
        $image = $request->file('category_image');
        $image_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('adminbackend/upload/category/' . $image_gen);
        $save_url = 'adminbackend/upload/category/' . $image_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace("", "-", $request->category_name)),
            'category_image' => $save_url,
        ]);
        $notification = array([
            'message' => 'Successfully added new brand',
            'alert-type' => 'success',
        ]);
        return redirect()->route('all.category')->with($notification);
    }
    public function EditCategory($id)
    {
        $category = Category::findorFail($id);
        return view('admin.category.category_edit', compact('category'));
    }
    public function UpdateCategory(Request $request)
    {

        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('adminbackend/upload/category/' . $name_gen);
            $save_url = 'adminbackend/upload/category/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }
            @dd($request->category_name);

            Category::findorFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } else {

            Category::findorFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Brand Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } // end else

    } // End Method

    public function DeleteCategory($id)
    {
        Category::findorFail($id)->delete();


        // if ($brand->brand_image == ""  || isset($brand->brand_image)) {
        //     // @dd($brand->brand_image);
        //     unlink($brand->brand_image);
        // }


        // Category::findorFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
