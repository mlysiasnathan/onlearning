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

Route::get('/', function () {
    $categories = LessonCategory::orderBy('created_at')->take(3)->get();
    return view('index', [
        'categories' => $categories,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/categories',[CategoriesController::class, 'index'] )->name('categories.all');

Route::get('/category/{name}',[CategoriesController::class, 'show'] )->name('category.show');

Route::get('/category/{name}/course/{course_name}',[CoursesController::class, 'show'] )->name('course.show');

Route::get('/users', [UsersController::class, 'users'])->name('users');



require __DIR__.'/auth.php';
