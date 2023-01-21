<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Team;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Portfolio;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
      
        return Inertia::render('Index');
    }
    
    public function login(){ 
        return Inertia::render('Backend/Login');
    }

    public function user_register_form() {
        return Inertia::render('Backend/UserRegister');
   }
  
    public function user_register(Request $request)
    {
 
         $request->validate([
                'user_name'=>'required|string|max:255',
                // 'email'=> 'required|unique:users',
                'email'=> 'required',
                'password' => 'required|required_with:confirm_password|same:confirm_password',
                 'confirm_password' => 'required|required_with:password|same:password',
         ]);
         $User = new User;
         $User->name = $request->user_name;
         $User->email = $request->email;
         $User->role = $request->role;         
         $User->password = Hash::make($request->password);
         
         $User->save();

        // process for customize email sending...
        $Email = Setting::where('type', 'email_section')->first();
        $email_test = json_decode($Email->value);

        $email_test = $email_test[0]->description;
        $user = $request->user_name;
 
        $healthy = array('${USER}');
        $yummy = array($user);
        
        $email_test = str_replace($healthy, $yummy, $email_test);

        //  $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
         //Generate, the password reset link. The token generated is embedded in the link
         $url = url('/');
         $token = Str::random(64);
         $link = $url . '/verify-email/' . $token . '?email=' . urlencode($request->email);
        $dataforEmail = [
            'verify_email' => $link,
            'customized_email' => $email_test
        ];

        $user_email = $request->email;
        
        $mail_subject = 'CRM account verification';

        
        // return view('emails.schedule_tasks', compact('user', 'events_and_tasks'));
        Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

            $message->to($user_email)->subject($mail_subject);

        });

        return back(303);
  
    }

    public function verify_email(Request $request)
    {
    $verified_user = User::where('email',$request->email)->whereNotNull('email_verified_at')->first(); 
    if($verified_user)
    {
        return redirect('errors/404-page');
    }
    else{
        $user = User::where('email',$request->email)->first();

        if($user)
        {
            $user->email_verified_at = Carbon::now();
            $user->save(); 

            return Inertia::render('Backend/Login', [
                'message' => "Email Verified Successfully now you can login.",  
            ]); 
        }
    }
        
    }

    public function forgot_password(Request $request)
    { 
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
 
        $token = Str::random(64);
 
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
        //   dd("tesoiign  ");
           

        //Get the token just created above
        $verifying = DB::table('users')->where('email', $request->email)->whereNotNull('email_verified_at')->first();
        
        if($verifying)
         {

             $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
     
             if ($this->sendResetEmail($request->email, $tokenData->token)) {
                 return back(303); 
             }  
         }else{
            return response()->json([
                'errors' => [
                    'email' => ['The provided email is not verified in our records please first verify email.'],
                ],
                'message' => "Please Verify Your Email.",
            ], 422);
         }
        

    }

    private function sendResetEmail($email, $token)
    {
         
        //Retrieve the user from the database
        $user_record = DB::table('users')->where('email', $email)->select('name', 'email')->whereNotNull('email_verified_at')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        
        $url = url('/');
        $link = $url . '/password-reset/' . $token . '?email=' . urlencode($user_record->email);
 
        // process for customize email sending...
        $Email = Setting::where('type', 'reset_password_email_section')->first();
         
        $email_test = json_decode($Email->value);

        $email_test = $email_test[0]->description;
        $user = $user_record->name;
         
 
        $healthy = array('${USER}');
        $yummy = array($user);
        
        $reset_email = str_replace($healthy, $yummy, $email_test);

 
        $dataforEmail = [
            'link' => $link,
            'reset_email'=> $reset_email,
        ];

        $user_email = $user_record->email;
        
        $mail_subject = 'CRM Account Password Reset.';

        // return view('emails.schedule_tasks', compact('user', 'events_and_tasks'));
        Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

            $message->to($user_email)->subject($mail_subject);

        });  
    }
    public function resetPasswordVue(Request $request)
    { 
        $tokenDataValidate = DB::table('password_resets')
    ->where('token', $request->token)->where('email', $request->email)->first();

    $user = User::where('email',$request->email)->first();

    if($tokenDataValidate)
      {
        return Inertia::render('Backend/resetPassword',[
            'user_id' => $user->id,
        ]);
      }
      else{
          
        return redirect('errors/404-page');
      }
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|required_with:password|same:password',
        ]);
        

        $user =  User::findOrFail($request->user_id);

        $tokenDataValidate = DB::table('password_resets')->where('email', $user->email)->first(); 
        //  dd($tokenDataValidate);
        $user->password = Hash::make($request->password);
        $user->token = $tokenDataValidate->token;
        $user->save();

        DB::table('password_resets')->where('email', $user->email)->delete();
        return Inertia::render('Backend/Login', [
            'message' => "Password Reset Successfully now you can login.",  
        ]); 

    }


    public function login_user(Request $request){
         
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
            if($user)
            { 
                $auth_token = $user->createToken('webToken')->plainTextToken;
                session()->put('auth_token', $auth_token);
                return back(303);
            }else{
                return response()->json([
                    'errors' => [
                        'email' => ['The provided email is not verified in our records.'],
                    ],
                    'message' => "Please Verify Your Email.",
                ], 422);
            }
            
        }

        return response()->json([
            'errors' => [
                'email' => ['The provided credentials do not match our records.'],
            ],
            'message' => "The given data was invalid.",
        ], 422);
    }

    public function logout_user(Request $request){

        session()->forget('auth_token');

        Auth::user()->tokens()->delete();
        
        Auth::guard('web')->logout();
        
    }

    public function forgotPassword(){
        return Inertia::render('Backend/forgotPassword');
    }

    function chart_testing(){
        return Inertia::render('Backend/Chart/Index');
    }
    function pie_testing(){
        return Inertia::render('Backend/Chart/Pie');
    }
   

////////////////////////////////////////////////////////////////
// /*data fetching for front end  starts*///////////////////////
////////////////////////////////////////////////////////////////

    public function services(Request $request){
        return Service::all();
    }

    public function team(Request $request){
        return Team::all();
    } 


    public function faq(Request $request){
        return Faq::OrderBy('ordering', 'asc')->get();
    }

    public function client(Request $request){
        return Client::all();
    }

    public function portfolio(Request $request){
        return Portfolio::all();
    }

    public function portfolio_details($id){
       
         return Inertia::render('Portfolio_details',[
            'portfolioId' => $id
        ]);

    }

     public function portfolio_fetch($id){
        $portfolio = Portfolio::findOrFail($id);
        return $portfolio;
    }

    public function portfolioMobileApp(){
         
        return Portfolio::where('category','Mobile App')->get();
    }

    public function portfolioWebApp(){
         
       return Portfolio::where('category','Web App')->get();
    }
////////////////////////////////////////////////////////////////
        /*data fetching for front end  ends*/
////////////////////////////////////////////////////////////////

 public function update_password(Request $request)
    {
         
         $request->validate([
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
                ]);
                return back(303);
            }
    }

    public function UserprofileShow(){
         
        $userId = User::findOrFail(auth()->user()->id);
         
        return Inertia::render('Backend/Talents/Talent_Profile',[
            'userId' => $userId
        ]);
    }
    
    public function profile_update(Request $request){
        $request->validate([
            'user_name'       => 'required|string|max:255',   
        ]);

        $User = User::findOrFail(auth()->user()->id);
        $User->name = $request->user_name;

        $User->save();
        return back(303);

        
    }
 

}