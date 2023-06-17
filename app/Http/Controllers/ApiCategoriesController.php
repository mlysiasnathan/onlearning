<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonCategory;
use Illuminate\Support\Facades\Gate;

class ApiCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'create',]);;
    }
    public function index()
    {
        $categories = LessonCategory::all();
        return response([
            'categories' => $categories,
        ], 200);
    }

    public function show(string $cat_name)
    {
        $category = LessonCategory::where('cat_name', $cat_name)->first();
        if (! $category) {
            return response([
                'message' => 'Category not found'
            ], 404);
        }
        return response([
            'category' => LessonCategory::where('cat_name', $cat_name)->first(),
            'courses' => $category->lessons
        ], 200);
    }

    public function create()
    {
        if (Gate::denies('isAdmin')) {
            return response([
                'message' => 'Admin Permissions needed',
            ], 403);
        }
        return view('add_cat');
    }

    public function update(int $cat_id)
    {
        if (Gate::denies('isAdmin')) {
            abort('403');
        }
        $category = LessonCategory::findOrFail($cat_id);
        return view('add_cat' , compact('category'));
    }

    public function store(Request $request, ?int $cat_id = null)
    {
        if (Gate::denies('isAdmin')) {
            return response([
                'message' => 'Admin Permissions needed',
            ], 403);
        }
        if ($request->routeIs('category.update.store')) {

            $request->validate([
                'name' => ['required' , 'min:2'],
                'description' => ['required',],
                'image' => ['required',],
            ]);

            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/categories', $filename, 'public');

            $category = LessonCategory::find((int)$cat_id);
            if (! $category) {
                return response([
                    'message' => 'Category not found'
                ], 404);
            }
            $category->update([
                'cat_name' => $request->name,
                'cat_description' => $request->description,
                'cat_img' => $image_path,
                'cat_img' => 'null',
                'updated_at' => now(),
            ]);

            return response([
                'message' => 'category updated',
                'category' => $category
            ], 200);

        } else {

            $request->validate([
                'name' => ['required' , 'min:2' , 'unique:lesson_categories,cat_name'],
                'description' => ['required',],
                'image' => ['required',],
            ]);
            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/categories', $filename, 'public');
            
            $category = LessonCategory::create([
                'cat_name' => $request->name,
                'cat_description' => $request->description,
                'cat_img' => $image_path,
                'cat_img' => 'null',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return response([
                'message' => 'category created',
                'category' => $category
            ], 200);
        }
    
    }

    public function delete(int $cat_id)
    {
        if (Gate::denies('isAdmin')) {
            return response([
                'message' => 'Admin Permissions needed',
            ], 403);
        }
        $category = LessonCategory::find($cat_id);
        if (! $category) {
            return response([
                'message' => 'Video not found'
            ], 404);
        }
        $category->delete();
        return response([
            'message' => 'category deleted',
        ], 200);
    }
}
