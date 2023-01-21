<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Talent;

class AdminController extends Controller
{
    public function index(){ 
        $Role =auth()->user()->role;
        
        if($Role == 'user')
        {
            $talent_record  = Talent::where('normal_user_id',auth()->user()->id)->first(); 
            
            if($talent_record){
               return Inertia::render('Backend/Talent_Profile/Index',['user_id' => auth()->user()->id,'Welcome_message'=>'Welcome To Your Profile Mr']);
            }else{
                 
                return Inertia::render('Backend/Talent_Profile/Create',['user_id' => auth()->user()->id, 'talent_inquiry'=>'UnRegistered']);
            }

        }else{

            return Inertia::render('Backend/Index');

        }
    }

    public function user_profile(){
        $user_id = User::find(auth()->user()->id);       
        return Inertia::render('Backend/Profile',[
            'userId' => $user_id
        ]);
        
    }
    public function profile_update(){
        $talent_record  = Talent::where('normal_user_id',auth()->user()->id)->first(); 
        $talent_id = $talent_record->id;
        
        return Inertia::render('Backend/Profile',[
            'userId' => $user_id
        ]);
        
    }
}
