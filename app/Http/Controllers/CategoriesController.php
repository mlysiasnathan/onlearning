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

    public function show(string $cat_name)
    {
        $category = LessonCategory::where('cat_name', $cat_name)->firstOrFail();
        return view('category-detail', [
            'category' => $category,
        ]);
    }

    public function create()
    {
        return view('add_cat');
    }

    public function store(Request $request, ?int $cat_id = null)
    {
        if ($request->routeIs('category.update.store')) {

            $request->validate([
                'name' => ['required' , 'min:2'],
                'description' => ['required',],
                'image' => ['required',],
            ]);

            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/categories', $filename, 'public');

            $category = LessonCategory::findOrFail((int)$cat_id);
            $category->update([
                'cat_name' => $request->name,
                'cat_description' => $request->description,
                'cat_img' => $image_path,
                'updated_at' => now(),
            ]);
            dd('category updated');

        } else {

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
    
            dd('category created');
        }
    
    }

    public function update(int $cat_id)
    {
        $category = LessonCategory::findOrFail($cat_id);
        return view('add_cat' , compact('category'));
    }

    public function delete(int $cat_id)
    {
        LessonCategory::findOrFail($cat_id)->delete();
        dd('Category deleted !');
    }
}
