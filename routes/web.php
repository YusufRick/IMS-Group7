<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Redirect root based on authentication status
Route::get('/', function () {
    return Auth::check() ? redirect('/admin/dashboard') : view('welcome');
});

// Login route
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Auth::routes();

// Redirecting /home to dashboard
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});

// Grouping admin routes with auth middleware
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('setting', [AdminController::class, 'Setting'])->name('admin.setting');
    Route::post('setting/update', [AdminController::class, 'settingStore'])->name('settings.update');
    Route::get('profile_edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('change_password', [AdminController::class, 'changePassword'])->name('admin.password.change');
    Route::post('password/store', [AdminController::class, 'passwordStore'])->name('admin.password.store');

    // Branch Controller
    Route::get('branches/list', [BranchController::class, 'getBranches'])->name('branches.list');
    Route::resource('branches', BranchController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('products/list', [ProductController::class, 'getProducts'])->name('products.list');
    Route::resource('products', ProductController::class);
    //Inventory Management
    Route::get('inventories/list', [InventoryController::class, 'getInventories'])->name('inventory.list');
    Route::resource('inventory', InventoryController::class);
    Route::get('sales/list', [SaleController::class, 'list'])->name('sales.list');
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
   // Display user registration requests
Route::get('/user_request', [AdminController::class, 'showUserRequests'])->name('admin.userRequests');
Route::get('sales/{id}/download', [SaleController::class, 'downloadPdf'])->name('sales.downloadPdf');
Route::get('/sales/{id}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/sales-report', [SaleController::class, 'salesReport'])->name('sales.report');
Route::post('/sales-report/generate', [SaleController::class, 'generateReport'])->name('sales.generateReport');
Route::get('/sales-report/download', [SaleController::class, 'downloadReport'])->name('sales.downloadReport');
// Activate a user
Route::post('/users_activate/{id}', [AdminController::class, 'activateUser'])->name('admin.activateUser');
Route::get('/api-documentation', function () {
    return view('apisection');
})->name('api.documentation');
});

// Other routes that can be accessed by authenticated users
Route::get('profile_edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('change_password', [AdminController::class, 'changePassword'])->name('admin.password.change');
Route::post('password/store', [AdminController::class, 'passwordStore'])->name('admin.password.store');
Route::get('customer_signup', [CustomerController::class, 'registerCustomer'])->name('admin.customer.register');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');