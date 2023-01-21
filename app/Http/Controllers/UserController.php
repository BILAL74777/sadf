<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Talent;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia; 
use Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
     public function index() {
          return Inertia::render('Backend/User/Index');
     }
    
     public function profile()
     {  
          $id = Auth::user()->id;
          return Inertia::render('Backend/Profile/Update',[
               'userId' => $id
           ]);
     }
     public function users()
     {   
          $users = User::all();
          return $users;
     }


     public function show($id){
          $Users = User::findOrFail($id);
          return $Users;
     }
     public function profile_show($id){
          $Users = User::findOrFail($id);
          return $Users;
     }

     public function edit($id){ 
          return Inertia::render('Backend/User/Update',[
              'userId' => $id
          ]);
      }
  
      public function profile_update(Request $request){
        
          $request->validate([
               'name' => 'required',
              'email' => 'required',
             'current_password'       => 'required|string|max:255',
             'new_password'           => 'required|required_with:confirm_password|same:confirm_password',
             'confirm_password'       => 'required|required_with:new_password|same:new_password',
                 
         ]);
 
          $data = $request->all();
 
             $user = User::find(auth()->user()->id);
 
             if (!Hash::check($data['current_password'], $user->password)) {
                  return response()->json([
             'errors' => [
                 'current_password' => ['The provided current Password do not match our records.'],
             ],
             'message' => "The given data was invalid.",
         ], 422);
             } else { 
                 $user->update([
                     'password' => Hash::make($request->new_password),
                     'name' => $request->name,
                     'email'=>$request->email,
                 ]);
                 return back(303);
             }
     }
      public function update(Request $request){
          $request->validate([
               
              'name' => 'required',
              'email' => 'required',
              'role' => 'required',
               
          ]);
   
              $Users = User::findOrFail($request->id);
              $Users->name = $request->name;
              $Users->email = $request->email;
              $Users->role = $request->role;
              
  
          $Users->save();
  
          return back(303);
      }
  
  
      public function delete($id){
          
          $Users = User::findOrFail($id); 
          $Users->delete();
  
          return back(303);
      }

     

 
}
