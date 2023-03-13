<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('front_end.index');
});
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); // Gorup Milldeware End

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'viewprofile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/profile/changepassword', [AdminController::class, 'AdminChangePassword'])->name('admin.changepassword');
    Route::post('/admin/profile/updatepassword', [AdminController::class, 'StorePassword'])->name('admin.change.password');
});
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'viewprofile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/profile/changepassword', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/profile/updatepassword', [VendorController::class, 'Storepassword'])->name('vendor.changepassword');
});

Route::middleware(['auth', 'role:admin'])->group(
    function () {
        //Brand Controller
        Route::controller(BrandController::class)->group(function () {
            Route::get('/all/brand', 'AllBrand')->name('all.brand');
            Route::get('/add/brand', 'AddBrand')->name('add.brand');
            Route::post('/add/store/brand', 'StoreBrand')->name('admin.brand.store');

            Route::get('/brand/edit/{id}', 'EditBrand')->name('edit.brand');
            Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
            Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
        });
        //Category Controller
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/all/category', 'AllCategory')->name('all.category');
            Route::get('/add/category', 'AddCategory')->name('add.category');
            Route::post('/add/store/category', 'StoreCategory')->name('admin.category.store');

            Route::get('/category/edit/{id}', 'EditCategory')->name('edit.category');
            Route::post('/update/category', 'UpdateCategory')->name('update.category');
            Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        });
        //SubCategory Controller
        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
            Route::get('/add/Subcategory', 'AddSubCategory')->name('add.subcategory');
            Route::post('/add/store/Subcategory', 'StoreSubCategory')->name('store.subcategory');

            Route::get('/subcategory/edit/{id}', 'EditSubCategory')->name('edit.subcategory');
            Route::post('/update/Subcategory', 'UpdateSubCategory')->name('update.subcategory');
            Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
        });

        // Vendor Active and Inactive All Route
        Route::controller(AdminController::class)->group(function () {
            Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
            Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
            // inactive vendor details
            Route::get('/inactive/vendor/details/{id}', 'InActiveVendorDetails')->name('inactive.vendor.details');
            Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');

            //active vendor details
            Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
            Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');

            //Product Controller All Route
            Route::controller(ProductController::class)->group(function () {
                Route::get('/all/product', 'AllProduct')->name('all.product');
                Route::get('/add/product', 'AddProduct')->name('add.product');
            });
        });
    }
); //END Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');;
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');
require __DIR__ . '/auth.php';
