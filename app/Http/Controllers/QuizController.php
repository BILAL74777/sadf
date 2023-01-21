<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Quiz;
use App\Models\QuizzesQuestions;
use App\Models\QuestionsAnswers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class QuizController extends Controller
{
    public function apply(Request $request)
    {
        $url = url('/');
        $token = Str::random(64);
        $link = $url . '/access-stepper/' . $token . '?email=' . urlencode($request->email);
        $dataforEmail = [
            'access_link' => $link
        ];

        $user_email = $request->email;
        
        $mail_subject = 'Welcome to our website';

        
        // return view('emails.schedule_tasks', compact('user', 'events_and_tasks'));
        Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

            $message->to($user_email)->subject($mail_subject);

        });

    }
    public function access_stepper(Request $request)
    {
         
        return Inertia::render('Stepper', [
            'email' => $request->email 
        ]); 
    }
    
    public function index(){
        return Inertia::render('Backend/Quiz/Index');
    }

    public function add(){
        return Inertia::render('Backend/Quiz/Create');
    }

    //  public function edit($id){
    //     return Inertia::render('Backend/Quiz/Update',[
    //         'contactId' => $id
    //     ]);
    // }

    //  public function quiz(Request $request){        
       
    //     $quiz = Quiz::all();
    //     return $quiz;

    // }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'title'       => 'required|string|max:255',
            'video_url' => 'required|string|max:255',
            // 'questio n'       => 'required',      
        ]);
          
            $Quiz = new Quiz;
                       
            $Quiz->id = Str::orderedUuid();
            $Quiz->title = $request->title;
            $Quiz->video_url = $request->video_url;
            $Quiz->save();
             
            $lists = (json_decode($request->questions_answers_list));
            foreach ($lists as $list) {
              
                  
                     
                        $questions = new QuizzesQuestions;
                        $questions->id = Str::orderedUuid();
                        $questions->quiz_id = $Quiz->id; 
                        $questions->question = $list->question; 
                        $questions->save();

                        foreach ($list->answer as $answer) {

                            $answers = new QuestionsAnswers;
                            $answers->id = Str::orderedUuid();
                            $answers->question_id = $questions->id;
                            $answers->answer = $answer;
                            if($list->rightAnswer == $answer)
                            {
                                $answers->status = 1;
                            }
                            
                            $answers->save();

                        }
 

                    
                        
                        
                        
                    }
                    
                    
                    $Quiz->save();
                    return 'success';

            // return back(303);
    }


    // public function show($id){
    //     $quizzes = Quiz::findOrFail($id);
    //     return $quizzes;
    // }

    // public function update(Request $request){
    //     $request->validate([
    //         'contact_type'       => 'required|string|max:255',
    //         'description' => 'required|string|max:255',
    //         'date'       => 'required',      
    //     ]);
 
    //     $Quiz = Quiz::findOrFail($request->id);
    //     $Quiz->type = $request->contact_type;
    //     $Quiz->description = $request->description;
    //     $Quiz->date = $request->date;

    //     $Quiz->save();

    //     return back(303);
    // }


    // public function delete($id){
        
    //     $Quiz = Quiz::findOrFail($id); 
    //     $Quiz->delete();

    //     return back(303);
    // }


    public function get_quiz_stepper()
    {
        $quizzes = Quiz::all(); 

         foreach($quizzes as $quiz)
         {
             $questions =  QuizzesQuestions::where('quiz_id',$quiz->id)->get();

             foreach ($questions as $key => $question) 
             {
                 

                $answers =  QuestionsAnswers::where('question_id',$question->id)->get();

                foreach ($answers as $key => $answer) 
                {
                    $answer->answers = $answer->answer; 
                }
                $question->answers = $answers;
               
            }
            
            $quiz->questions = $questions;
             
         } 
         
        return $quizzes;
    }
    
}