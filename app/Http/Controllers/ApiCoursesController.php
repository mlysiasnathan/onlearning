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
        $this->middleware('auth:sanctum')->except(['create', 'download_doc']);
    }

    public function show(string $cat_name, string $les_name)
    {
        $category = LessonCategory::where('cat_name' , $cat_name)->first();
        if (! $category) {
            return response([
                'message' => 'Category not found'
            ], 404);
        }
        $lesson = Lesson::where('les_name' , $les_name)->first();
        if (! $lesson) {
            return response([
                'message' => 'Lesson not found'
            ], 404);
        }
        $course = Lesson::whereRaw("cat_id = $category->cat_id and les_id = $lesson->les_id")->first(); 
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }

        if ($course){
            return response([
                'course' => $course
            ], 200);
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
                // 'image' => ['required',],
            ]);

            // $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            // $image_path = $request->image->storeAs('img/courses', $filename, 'public');

            $course = Lesson::find((int)$les_id);
            if (! $course) {
                return response([
                    'message' => 'Course not found'
                ], 404);
            }
            $category = LessonCategory::find((int)$cat_id);
            if (! $category) {
                return response([
                    'message' => 'Category not found'
                ], 404);
            }
            $course->update([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => $category->cat_id,
                'les_price' => (int)$request->price,
                // 'les_img' => $image_path,
                'les_img' => 'null',
                'updated_at' => now(),
            ]);
            return response([
                'message' => 'Course updated Successfully',
                'course' => $course
            ], 200);

        } else {

            $request->validate([
                'name' => ['required' , 'min:2' , 'unique:lessons,les_name'],
                'description' => ['required',],
                // 'image' => ['required',],
            ]);
            // $filename = str_replace(' ', '_',$request->name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->image->extension();
            // $image_path = $request->image->storeAs('img/courses', $filename, 'public');

            $category = LessonCategory::find((int)$cat_id);
            if (! $category) {
                return response([
                    'message' => 'Category not found'
                ], 404);
            }
            $course = Lesson::create([
                'les_name' => $request->name,
                'les_content' => $request->description,
                'cat_id' => (int)$category->cat_id,
                'les_price' => (int)$request->price,
                // 'les_img' => $image_path,
                'les_img' => 'null',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response([
                'message' => 'Course created Successfully',
                'course' => $course
            ], 200);
        }
        
    }

    public function update(int $cat_id, int $les_id)
    {
        $category = LessonCategory::find($cat_id);
        if (! $category) {
            return response([
                'message' => 'Category not found'
            ], 404);
        }
        $course = Lesson::find($les_id);
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }
        return view('add_course' , compact('course' , 'category'));
    }

    public function delete(int $les_id)
    {
        $course = Lesson::find($les_id)->delete();
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }
        return response([
            'message' => 'Course deleted Successfully',
        ], 200);
    }

    public function store_doc(Request $request, int $les_id)
    {
        $request->validate([
            'document' => ['required'],
        ]);

        $course = Lesson::find($les_id);
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }
        $filename = 'doc_of_' . str_replace(' ', '_',$course->les_name)  . now()->format('_Y_M_d_H\h-i'). '.' . $request->document->extension();
        $doc_path = $request->document->storeAs('documents', $filename, 'public');

        $doc = LessonPdf::create([
            'les_id' => $course->les_id,
            'pdf_file' => $doc_path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response([
            'message' => 'Document created Successfully',
            'document' => $doc
        ], 200);
    }

    public function download_doc(int $pdf_id)
    {
        $doc = LessonPdf::find($pdf_id);
        if (! $doc) {
            return response([
                'message' => 'Document not found'
            ], 404);
        }
        
        if (Storage::disk('public')->exists($doc->pdf_file)) {
            // return Storage::download($doc->pdf_file);
            // return redirect(Storage::url($doc->pdf_file));
            return response([
                'message' => 'Document dowloaded Successfully',
                'document' => Storage::url($doc->pdf_file)
            ], 200);
        } else {
            return response([
                'message' => 'Document not exists',
            ], 404);
        }
        
    }

    public function delete_doc(int $doc_id)
    {
        $doc = LessonPdf::find($doc_id);
        if (! $doc) {
            return response([
                'message' => 'Document not found'
            ], 404);
        }
        $doc->delete();
        return response([
            'message' => 'Document deleted successfully',
        ], 200);
    }

    public function store_video(Request $request, int $les_id)
    {
        $request->validate([
            'video_link' => ['required'],
            'video_name' => ['required'],
        ]);

        $course = Lesson::find($les_id);
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }
        $video = LessonVideo::create([
            'les_id' => $course->les_id,
            'vid_name' => $request->video_name,
            'vid_file' => $request->video_link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response([
            'message' => 'Video added successfully',
            'video' => $video
        ], 200);
    }

    public function update_video(Request $request, int $les_id, int $vid_id)
    {
        $request->validate([
            'video_link' => ['required'],
            'video_name' => ['required'],
        ]);

        $course = Lesson::find($les_id);
        if (! $course) {
            return response([
                'message' => 'Course not found'
            ], 404);
        }
        $video = LessonVideo::find($vid_id);
        if (! $video) {
            return response([
                'message' => 'Video not found'
            ], 404);
        }
        $video->update([
            'vid_name' => $request->video_name,
            'vid_file' => $request->video_link,
            'updated_at' => now(),
        ]);
        return response([
            'message' => 'Video updated successfully',
            'video' => $video
        ], 200);
        
    }

    public function delete_video(int $vid_id)
    {
        $video = LessonVideo::find($vid_id);
        if (! $video) {
            return response([
                'message' => 'Video not found'
            ], 404);
        }
        $video->delete();
        return response([
            'message' => 'Video deleted successfully',
        ], 200);
    }
    
}
