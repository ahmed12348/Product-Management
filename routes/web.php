<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->get('/', function () {
    return redirect()->route('dashboard.index');

});



// Register Route
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Authentication Routes
Auth::routes();

// Routes for authenticated users with the /dashboard prefix Authentication Routes
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    // Default dashboard route
    Route::resource('/', DashboardController::class);

    // Resource routes within /dashboard prefix
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
      // List of all products
      Route::get('/products', [ProductController::class, 'index'])->name('products.index');

      // Show the form to create a new product
      Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
  
      // Store a newly created product
      Route::post('/products', [ProductController::class, 'store'])->name('products.store');
  
      // Show a specific product
      Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
  
      // Show the form to edit a specific product
      Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
  
      // Update a specific product
      Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
  
      // Delete a specific product
      Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

});
