<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lesson;
use Illuminate\Support\Str;
 

class LessonController extends Controller
{
    public function index()
    {
        return Inertia::render('Backend/Lesson/Index');
    }

    public function add()
    {
        return Inertia::render('Backend/Lesson/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Backend/Lesson/Update', [
            'lesson_id' => $id,
        ]);
    }

    public function lessons(Request $request)
    {

        $lessons = Lesson::all();
        return $lessons;

    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'descriptions' => 'required|string|max:255',
        ]);

        $lesson = new Lesson;
        $lesson->id = Str::orderedUuid();
        $lesson->title = $request->title;
        $lesson->descriptions = $request->descriptions;

        $lesson->save();

        return back(303);
    }

    public function show($id)
    { 
        $lesson = Lesson::findOrFail($id);
        return $lesson;
    }

    public function update(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',
            'descriptions' => 'required|string|max:255',

        ]);

        $lesson = Lesson::findOrFail($request->id);
        $lesson->title = $request->title;
        $lesson->descriptions = $request->descriptions;

        $lesson ->save();

        return back(303);
    }

    public function delete($id)
    {

        $lesson = Lesson::findOrFail($id);
        $lesson ->delete();

        return back(303);
    }

    public function details($id)
    {
        return Inertia::render('Backend/Lesson/Details', [
            'lesson_id' => $id,
        ]); 
    }
    
    public function fetch_details($id)
    {
        $lesson = Lesson::findOrFail($id);
        return $lesson; 
    }

    public function access_lessons(Request $request)
    {
         
        return Inertia::render('Lessons', [
            'email' => $request->email 
        ]); 
    }

    // Below methods are for front end quiz attempting... 
    public function user_lesson_details($id,$email)
    {
         
        return Inertia::render('Stepper', [
            'lesson_id' => $id,'email'=>$email
        ]); 
    }
}
