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

//--Home's Routes

// $categories = LessonCategory::orderBy('created_at', 'desc')->take(3)->get();

Route::get('/', function () { return view('index');})->name('home');

//--Categories' Routes

Route::get('/categories',[CategoriesController::class, 'index'] )->name('categories.all');

Route::get('/category/create',[CategoriesController::class, 'create'] )->name('category.create');

Route::post('/category/create',[CategoriesController::class, 'store'] )->name('category.store');

Route::post('/category/{cat_id}/update',[CategoriesController::class, 'store'] )->whereNumber('cat_id')->name('category.update.store');

Route::get('/category/{cat_name}',[CategoriesController::class, 'show'] )->name('category.show');

Route::get('/category/{cat_id}/update',[CategoriesController::class, 'update'] )->whereNumber('cat_id')->name('category.update');

Route::get('/category/{cat_id}/delete',[CategoriesController::class, 'delete'] )->whereNumber('cat_id')->name('category.delete');

//--Courses' Routes

Route::get('/category/{cat_id}/course/create',[CoursesController::class, 'create'] )->whereNumber('cat_id')->name('course.create');

Route::post('/category/{cat_id}/course/create',[CoursesController::class, 'store'] )->name('course.store');

Route::post('/category/{cat_id}/course/{les_id}/update',[CoursesController::class, 'store'] )->name('course.update.store');

Route::get('/category/{cat_name}/course/{les_name}',[CoursesController::class, 'show'] )->name('course.show');

Route::get('/category/{cat_id}/course/{les_id}/update',[CoursesController::class, 'update'] )->whereNumber('cat_id')->whereNumber('les_id')->name('course.update');

Route::get('/course/{les_id}/delete',[CoursesController::class, 'delete'] )->whereNumber('les_id')->name('course.delete');

//--Documents' Routes

Route::post('/course/{les_id}/doc/create',[CoursesController::class, 'store_doc'] )->whereNumber('les_id')->name('doc.create');

Route::get('/document/{pdf_id}/download',[CoursesController::class, 'download_doc'] )->whereNumber('pdf_id')->name('doc.download');

Route::get('/document/{pdf_id}/delete',[CoursesController::class, 'delete_doc'] )->whereNumber('pdf_id')->name('doc.delete');

//--Videos' Routes

Route::post('/course/{les_id}/video/create',[CoursesController::class, 'store_video'] )->whereNumber('les_id')->name('video.create');

Route::post('/course/{les_id}/video/{vid_id}/update',[CoursesController::class, 'update_video'] )->whereNumber('les_id')->whereNumber('vid_id')->name('video.update');

Route::get('video/{vid_id}/delete',[CoursesController::class, 'delete_video'] )->whereNumber('vid_id')->name('video.delete');

//--Users's Routes

Route::get('/users', [UsersController::class, 'users'])->name('users');



require __DIR__.'/auth.php';
