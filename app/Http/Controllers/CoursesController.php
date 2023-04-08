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

    public function create(int $cat_id)
    {
        return view('add_course')->with('category', $cat_id);
    }

    public function store(Request $request)
    {
        if ($request->routeIs('course.update.store')) {

            $request->validate([
                'name' => ['required' , 'min:2'],
                'description' => ['required',],
                'image' => ['required',],
            ]);

            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/courses', $filename, 'public');

            $course = Lesson::findOrFail((int)$request->course);
            $course->update([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => (int)$request->category,
                'les_price' => (int)$request->price,
                'les_img' => $image_path,
                'updated_at' => now(),
            ]);
            dd('course updated');

        } else {

            $request->validate([
                'name' => ['required' , 'min:2' , 'unique:lessons,les_name'],
                'description' => ['required',],
                'image' => ['required',],
            ]);
            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/courses', $filename, 'public');

            Lesson::create([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => (int)$request->category,
                'les_price' => (int)$request->price,
                'les_img' => $image_path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            dd('course created');
        }
        
    }

    public function update(int $cat_id, int $id)
    {
        $category = LessonCategory::findOrFail($cat_id);
        $course = Lesson::findOrFail($id);
        return view('add_course' , compact('course' , 'category'));
    }

    public function delete(int $id)
    {
        Lesson::findOrFail($id)->delete();
        dd('Course deleted !');
    }
}
