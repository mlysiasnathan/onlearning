<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUsersController;
use App\Http\Controllers\ApiCoursesController;
use App\Http\Controllers\ApiCategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/', function () { return view('index');})->name('home');

//--Categories' Routes

Route::get('/categories',[ApiCategoriesController::class, 'index'] )->name('categories.all');

Route::get('/category/create',[ApiCategoriesController::class, 'create'] )->name('category.create');

Route::post('/category/create',[ApiCategoriesController::class, 'store'] )->name('category.store');

Route::post('/category/{cat_id}/update',[ApiCategoriesController::class, 'store'] )->whereNumber('cat_id')->name('category.update.store');

Route::get('/category/{cat_name}',[ApiCategoriesController::class, 'show'] )->name('category.show');

Route::get('/category/{cat_id}/update',[ApiCategoriesController::class, 'update'] )->whereNumber('cat_id')->name('category.update');

Route::get('/category/{cat_id}/delete',[ApiCategoriesController::class, 'delete'] )->whereNumber('cat_id')->name('category.delete');

//--Courses' Routes

Route::get('/category/{cat_id}/course/create',[ApiCoursesController::class, 'create'] )->whereNumber('cat_id')->name('course.create');

Route::post('/category/{cat_id}/course/create',[ApiCoursesController::class, 'store'] )->name('course.store');

Route::post('/category/{cat_id}/course/{les_id}/update',[ApiCoursesController::class, 'store'] )->name('course.update.store');

Route::get('/category/{cat_name}/course/{les_name}',[ApiCoursesController::class, 'show'] )->name('course.show');

Route::get('/category/{cat_id}/course/{les_id}/update',[ApiCoursesController::class, 'update'] )->whereNumber('cat_id')->whereNumber('les_id')->name('course.update');

Route::get('/course/{les_id}/delete',[ApiCoursesController::class, 'delete'] )->whereNumber('les_id')->name('course.delete');

//--Documents' Routes

Route::post('/course/{les_id}/doc/create',[ApiCoursesController::class, 'store_doc'] )->whereNumber('les_id')->name('doc.create');

Route::get('/document/{pdf_id}/download',[ApiCoursesController::class, 'download_doc'] )->whereNumber('pdf_id')->name('doc.download');

Route::get('/document/{pdf_id}/delete',[ApiCoursesController::class, 'delete_doc'] )->whereNumber('pdf_id')->name('doc.delete');

//--Videos' Routes

Route::post('/course/{les_id}/video/create',[ApiCoursesController::class, 'store_video'] )->whereNumber('les_id')->name('video.create');

Route::post('/course/{les_id}/video/{vid_id}/update',[ApiCoursesController::class, 'update_video'] )->whereNumber('les_id')->whereNumber('vid_id')->name('video.update');

Route::get('video/{vid_id}/delete',[ApiCoursesController::class, 'delete_video'] )->whereNumber('vid_id')->name('video.delete');

//--Users's Routes

Route::get('/users', [ApiUsersController::class, 'index'])->name('users');

Route::get('/user/profil', [ApiUsersController::class, 'show'])->name('profil.show');

Route::post('/user/profil', [ApiUsersController::class, 'store'])->name('profil.store');

//not yet used
Route::get('/user/{user_id}/delete', [ApiUsersController::class, 'delete'])->name('profil.delete');



require __DIR__.'/apiauth.php';
