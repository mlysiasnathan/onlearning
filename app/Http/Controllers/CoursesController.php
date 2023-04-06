<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonPdf;
use App\Models\LessonVideo;
use Illuminate\Http\Request;
use App\Models\LessonCategory;

class CoursesController extends Controller
{
    public function show(string $name, string $course_name)
    {
        $category = LessonCategory::where('cat_name', $name)->firstOrFail();
        $lesson = Lesson::where('les_name', $course_name)->firstOrFail();
        $course = Lesson::whereRaw("cat_id = $category->cat_id and les_id = $lesson->les_id")->firstOrFail(); 

        if ($course){
            return view('lesson', [
                'course' => $course,
            ])->with('category_name' , $category->cat_name);
        } 
        
    }
}
