<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonCategory;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = LessonCategory::all();
        return view('categories', [
            'categories' => $categories,
        ]);
    }

    public function show(string $name)
    {
        $category = LessonCategory::where('cat_name',$name)->firstOrFail();
        return view('category-detail', [
            'category' => $category,
        ]);
    }

    public function create()
    {
        # code...
        return view('add_cat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required' , 'min:2' , 'unique:lesson_categories,cat_name'],
            'description' => ['required',],
            'image' => ['required',],
        ]);
        $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
        $image_path = $request->image->storeAs('img/categories', $filename, 'public');
        
        LessonCategory::create([
            'cat_name' => $request->name,
            'cat_description' => $request->description,
            'cat_img' => $image_path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        dd('cat created');
    }

    public function delete(int $id)
    {
        LessonCategory::findOrFail($id)->delete();
        dd('Category deleted !');
    }
}
