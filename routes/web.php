<?php

use App\Models\LessonCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TestPostController;
use App\Http\Controllers\CategoriesController;

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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    // $categories = LessonCategory::orderBy('created_at', 'desc')->take(3)->get();
    $categories = LessonCategory::orderBy('created_at', 'desc')->get();

    return view('index', [
        'categories' => $categories,
    ]);
})->name('home');

//--Categories' Routes

Route::get('/categories',[CategoriesController::class, 'index'] )->name('categories.all');

Route::get('/category/create',[CategoriesController::class, 'create'] )->name('category.create');

Route::post('/category/create',[CategoriesController::class, 'store'] )->name('category.store');

Route::get('/category/{name}',[CategoriesController::class, 'show'] )->name('category.show');

Route::get('/category/update{id}',[CategoriesController::class, 'update'] )->whereNumber('id')->name('category.update');

Route::get('/category/delete/{id}',[CategoriesController::class, 'delete'] )->whereNumber('id')->name('category.delete');

//--Courses' Routes

Route::get('/category/{cat_id}/course/create',[CoursesController::class, 'create'] )->whereNumber('cat_id')->name('course.create');

Route::post('/course/create',[CoursesController::class, 'store'] )->name('course.store');

Route::post('/course/update',[CoursesController::class, 'store'] )->name('course.update.store');

Route::get('/category/{name}/course/{course_name}',[CoursesController::class, 'show'] )->name('course.show');

Route::get('/category/{cat_id}/course/{id}/update',[CoursesController::class, 'update'] )->whereNumber('cat_id')->whereNumber('id')->name('course.update');

Route::get('/course/delete/{id}',[CoursesController::class, 'delete'] )->whereNumber('id')->name('course.delete');

//--Users's Routes

Route::get('/users', [UsersController::class, 'users'])->name('users');



require __DIR__.'/auth.php';
