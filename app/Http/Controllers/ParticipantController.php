<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Participant;
use Illuminate\Support\Str;
 

class ParticipantController extends Controller
{
    
    // public function email_send(Request $request)
    // {
    //     $request->validate([
            
    //         'mailing_option' => 'required',
    //         'subject' => 'required',
    //         'content' => 'required',
    //     ]);

        
        
    //     // $website_name = Setting::where('type', 'website_name')->first();
        
         
    //         // mailing option is zero because we are setted in array at to zero in index() method.
    //         $participants = explode(',',$request->mailing_option);
       
            
    //         foreach($participants as $participant)
    //         {
    //                 $applied_subscribers = Participant::where('event_id',$participant)->first();
    //                 $url = url('/');
    //                 $token = Str::random(64);
    //                 $unsubscribe_link = $url . '/unsubscribe/' . $token . '?subscriber_id=' . urlencode($applied_subscribers->id);

    //                 $dataforEmail = [
    //                     'subscriber_email' => 'subscriber_email',
    //                     'subscriber_name' => $applied_subscribers->participant_name,
    //                     'subscriber_email' => $applied_subscribers->email,
    //                     'content' => $request->content,
    //                     'website_name' => "Website name",
    //                     'unsubscribe_link' => $unsubscribe_link, 
    //                 ];
    //                 $user_email = $applied_subscribers->email;

    //                 $mail_subject = $request->subject;

    //                 Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

    //                     $message->to($user_email)->subject($mail_subject);

    //                 });
            
    //             } 
             
 
         
    //     return 'success';

    // }
}
