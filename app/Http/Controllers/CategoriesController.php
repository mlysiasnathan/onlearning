<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonCategory;

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
}
