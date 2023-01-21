<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsEmailScheduled;
use App\Models\Participant;
use App\Models\ScheduledEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ScheduledEmailsController extends Controller
{
    public function index()
    {
        return Inertia::render('Backend/Emails/Index');
    }
    public function fetch_schedulred_emails()
    {
        $ScheduledEmail = ScheduledEmail::all();
        foreach ($ScheduledEmail as $record) {
            $event_record = Event::where('id', $record->event_id)->first();
            if ($event_record) {
                $record->event = $event_record->title;
            }
        }
        return $ScheduledEmail;
    }
    public function email_send(Request $request)
    {
        $request->validate([
            'mailing_option' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);
        $time = json_decode($request->time);
        $db_time = $time->hours.':'.$time->minutes.':'.$time->seconds;
      
        $ScheduledEmails = new ScheduledEmail;
        $ScheduledEmails->id = Str::orderedUuid();
        $ScheduledEmails->subject = $request->subject;
        $ScheduledEmails->content = $request->content;
        $ScheduledEmails->day = $request->day;
        $ScheduledEmails->time = $db_time;
        $events_ids = explode(',', $request->mailing_option);

        foreach ($events_ids as $event_id) {

            $EventEmailScheduled = new EventsEmailScheduled;
            $EventEmailScheduled->id = Str::orderedUuid();
            $EventEmailScheduled->scheduled_email_id = $ScheduledEmails->id;
            $EventEmailScheduled->event_id = $event_id;
            $EventEmailScheduled->save();

        }
        $ScheduledEmails->save();
        return 'success';

    }

    public function edit($id)
    {

        $subscribers = Participant::where('event_id', '!=', '')->pluck('participant_name', 'id');
        $subscribers_ids = Participant::where('event_id', '!=', '')->pluck('event_id');
        $subscriber = Event::whereIn('id', $subscribers_ids)->pluck('title', 'id');

        return Inertia::render('Backend/Emails/Update', [
            'id' => $id, 'events_subscribers' => $subscriber,
        ]);
    }

    public function show($id)
    {

        $Record = ScheduledEmail::findOrFail($id);
        if($Record->time)
        {
            $exploded_time = explode(':',$Record->time);
            $hours =  $exploded_time[0];
            $minutes = $exploded_time[1];
            $hours_trimed = ltrim($hours, "0");
            $minutes_trimed = ltrim($minutes, "0");

             
             
            $Record->hours =  $hours_trimed;
            $Record->minuts =  $minutes_trimed;
        }
     
        
        $selected_dance_practices = EventsEmailScheduled::where('scheduled_email_id', $id)->pluck('event_id');
        

        return ['Record' => $Record, 'existing_selection' => $selected_dance_practices];

    }

    public function update(Request $request)
    { 
        $time = json_decode($request->time);
        $db_time = $time->hours.':'.$time->minutes.':'.$time->seconds;
         
        $request->validate([

            'mailing_option' => 'required',
            'subject' => 'required',
        ]);

        $existing_emails = EventsEmailScheduled::where('scheduled_email_id', $request->id)->get();
        if ($existing_emails) {

            foreach ($existing_emails as $mail) {

                $record = EventsEmailScheduled::where('id', $mail->id)->first();
                $record->delete();
            }
        }

        $ScheduledEmails = ScheduledEmail::findOrFail($request->id);
        //  dd($ScheduledEmails);
        $ScheduledEmails->subject = $request->subject;
        if($request->content)
        {
            $ScheduledEmails->content = $request->content;
        }
        $ScheduledEmails->day = $request->day;
        $ScheduledEmails->time = $db_time;
        $events_ids = explode(',', $request->mailing_option);

        foreach ($events_ids as $event_id) {

            $EventEmailScheduled = new EventsEmailScheduled;
            $EventEmailScheduled->id = Str::orderedUuid();
            $EventEmailScheduled->scheduled_email_id = $ScheduledEmails->id;
            $EventEmailScheduled->event_id = $event_id;
            $EventEmailScheduled->save();

        }
        $ScheduledEmails->save();
        return 'success';

    }

    public function delete($id)
    {

        $Task = ScheduledEmail::findOrFail($id);
        $existing_emails = EventsEmailScheduled::where('scheduled_email_id', $Task->id)->get();
        if ($existing_emails) {

            foreach ($existing_emails as $mail) {

                $record = EventsEmailScheduled::where('id', $mail->id)->first();
                $record->delete();
            }
        }
        $Task->delete();

        return 'success';
    }

}
