<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('admin.product.all_product', compact('products'));
    }
    public function AddProduct()
    {
        return view('admin.product.product_add');
    }
}
