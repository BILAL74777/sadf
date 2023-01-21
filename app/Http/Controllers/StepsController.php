<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Step;
use App\Models\Lesson;
use App\Models\StepsQuestionAnswers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StepsController extends Controller
{
    public function index($lesson_id){
        return Inertia::render('Backend/Lesson/StepCreate',['lesson_id'=>$lesson_id]);
    }

    public function add(){
        return Inertia::render('Backend/Step/Create');
    }

     public function edit($id){
        return Inertia::render('Backend/Step/Update',[
            'step_id' => $id
        ]);
    }

     public function steps(Request $request){        
       
        $steps = Step::all();
        return $steps;

    }

    public function store(Request $request){
        // dd($request->image);
        $request->validate([
            'title'       => 'required|string|max:255', 
            'image'       => 'required',      
        ]);
          
            $step = new Step;
            $step->id = Str::orderedUuid();
            $step->lesson_id = $request->lesson_id;
            $step->title = $request->title;
            
             
            if ($request->file('image')) {
                $step->image = $request->file('image')->store('LessonStepsImages');
            }
              
            $step->save();

            return back(303);
    }


    public function show($id){
        $step = Step::findOrFail($id);
        return $step;
    }

    public function update(Request $request){
        $request->validate([
            'contact_type'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date'       => 'required',      
        ]);
 
        $step = Step::findOrFail($request->id);
        $step->type = $request->contact_type;
        $step->description = $request->description;
        $step->date = $request->date;

        $step->save();

        return back(303);
    }


    public function delete($id){
        
        $step = Step::findOrFail($id); 
        $step->delete();

        return back(303);
    }

    public function lesson_steps_fetch($id){
        // dd($id);
        $steps = Step::where('lesson_id',$id)->get(); 
        // dd($steps);
        foreach($steps as $step)
        {
            $step->image = $step->image ? get_storage_url($step->image) : '';
            $questions_answers = StepsQuestionAnswers::where('step_id',$step->id)->get();
            
            $step->questions_answers = $questions_answers;
        }
        return $steps;
    }

    public function step_question_add($step_id,$lesson_id){
        return Inertia::render('Backend/Lesson/StepQuizCreate',['step_id'=>$step_id,'lesson_id' => $lesson_id]);
    }
    public function step_questions_store(Request $request){
        
        $request->validate([

            'question'      => 'required|string|max:250', 
            'answer1'       => 'required|string|max:250', 
            'answer2'       => 'required|string|max:250', 
            'answer3'       => 'required|string|max:250',  
            'correct_answer'       => 'required|string|max:250',  
                   
        ]);
          
            $question = new StepsQuestionAnswers;
            $question->id = Str::orderedUuid();
            $question->step_id = $request->step_id;
            $question->question = $request->question;
            $question->answer1 = $request->answer1;
            $question->answer2 = $request->answer2;
            $question->answer3 = $request->answer3;
            $question->correct_answer = $request->correct_answer;
             
            $question->save();
         
    }
}
