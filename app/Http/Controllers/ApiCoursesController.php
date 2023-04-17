<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonPdf;
use App\Models\LessonVideo;
use Illuminate\Http\Request;
use App\Models\LessonCategory;
use Illuminate\Support\Facades\Storage;

class ApiCoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'download_doc']);
    }
    public function show(string $cat_name, string $les_name)
    {
        $category = LessonCategory::where('cat_name' , $cat_name)->firstOrFail();
        $lesson = Lesson::where('les_name' , $les_name)->firstOrFail();
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

    public function store(Request $request, int $cat_id, ?int $les_id = null)
    {
        if ($request->routeIs('course.update.store')) {

            $request->validate([
                'name' => ['required' , 'min:2'],
                'description' => ['required',],
                'image' => ['required',],
            ]);

            $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            $image_path = $request->image->storeAs('img/courses', $filename, 'public');

            $course = Lesson::findOrFail((int)$les_id);
            $category = LessonCategory::findOrFail((int)$cat_id);
            $course->update([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => $category->cat_id,
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

            $category = LessonCategory::findOrFail((int)$cat_id);
            Lesson::create([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => (int)$category->cat_id,
                'les_price' => (int)$request->price,
                'les_img' => $image_path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            dd('course created');
        }
        
    }

    public function update(int $cat_id, int $les_id)
    {
        $category = LessonCategory::findOrFail($cat_id);
        $course = Lesson::findOrFail($les_id);
        return view('add_course' , compact('course' , 'category'));
    }

    public function delete(int $les_id)
    {
        Lesson::findOrFail($les_id)->delete();
        dd('Course deleted !');
    }

    public function store_doc(Request $request, int $les_id)
    {
        $request->validate([
            'document' => ['required'],
        ]);

        $course = Lesson::findOrFail($les_id);
        $filename = 'doc_of_' . str_replace(' ', '_',$course->les_name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->document->extension();
        $doc_path = $request->document->storeAs('documents', $filename, 'public');

        LessonPdf::create([
            'les_id' => $course->les_id,
            'pdf_file' => $doc_path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        dd('Document created successfully');
    }

    public function download_doc(int $pdf_id)
    {
        $doc = LessonPdf::findOrFail($pdf_id);
        
        if (Storage::disk('public')->exists($doc->pdf_file)) {
            // return Storage::download($doc->pdf_file);
            return redirect(Storage::url($doc->pdf_file));
            // dd('Document dowloaded Successfully');
        } else {
            dd('file not exists');
        }
        
    }

    public function delete_doc(int $doc_id)
    {
        LessonPdf::findOrFail($doc_id)->delete();
        dd('Document deleted successfully');
    }

    public function store_video(Request $request, int $les_id)
    {
        $request->validate([
            'video_link' => ['required'],
            'video_name' => ['required'],
        ]);

        $course = Lesson::findOrFail($les_id);
        LessonVideo::create([
            'les_id' => $course->les_id,
            'vid_name' => $request->video_name,
            'vid_file' => $request->video_link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        dd('Video added successfully');
    }

    public function update_video(Request $request, int $les_id, int $vid_id)
    {
        $request->validate([
            'video_link' => ['required'],
            'video_name' => ['required'],
        ]);

        Lesson::findOrFail($les_id);
        $video = LessonVideo::findOrFail($vid_id);
        $video->update([
            'vid_name' => $request->video_name,
            'vid_file' => $request->video_link,
            'updated_at' => now(),
        ]);
        dd('Video updated successfully');
    }

    public function delete_video(int $vid_id)
    {
        LessonVideo::findOrFail($vid_id)->delete();
        dd('Video deleted successfully');
    }
    
}
