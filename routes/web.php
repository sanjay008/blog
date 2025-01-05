<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/addblog', [BlogController::class, 'index'])->name('addblog');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/myblog', [BlogController::class, 'myblog'])->name('myblog');
        Route::delete('/deletblog/{id}', [BlogController::class, 'destroy'])->name('destroy');
        Route::get('/editblog/{id}', [BlogController::class, 'edit'])->name('editblog');
        Route::put('/updateblog/{id}', [BlogController::class, 'update'])->name('updateblog');


    });

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/updatestatus', [AdminController::class, 'updatestatus'])->name('updatestatus');
        Route::get('/categories', [CategoriesController::class, 'categories'])->name('categories');
        Route::get('/addcategories', [CategoriesController::class, 'addcategories'])->name('addcategories');
        Route::post('/storecategory', [CategoriesController::class, 'storecategory'])->name('storecategory');
        Route::delete('/deletcategory/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
        Route::get('/editcategory/{id}', [CategoriesController::class, 'edit'])->name('editcategory');
        Route::put('/updatecategory/{id}', [CategoriesController::class, 'update'])->name('updatecategory');
    });
});

require __DIR__.'/auth.php';
