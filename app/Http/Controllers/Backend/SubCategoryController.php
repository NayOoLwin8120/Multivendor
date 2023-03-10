<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubCategoryController extends Controller
{
    public function AllSubCategory()
    {
        $subcategory = SubCategory::latest()->get();
        return view('admin.subcategory.subcategory_all', compact('subcategory'));
    } // End Method

    public function AddSubCategory()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('admin.subcategory.subcategory_add', compact('categories'));
    } // End Method
    public function StoreSubCategory(Request $request)
    {


        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace("", "-", $request->subcategory_name)),

        ]);
        $notification = array([
            'message' => 'Successfully added new Subcategory',
            'alert-type' => 'success',
        ]);
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function EditSubCategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }
    public function UpdateSubCategory(Request $request)
    {

        $category_id = $request->id;

        SubCategory::findorFail($category_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace("", "-", $request->subcategory_name)),

        ]);
        $notification = array(
            'message' => 'SubCategory Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
    } // End Method

    public function DeleteSubCategory($id)
    {
        SubCategory::findorFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory  Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
