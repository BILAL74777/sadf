<?php

namespace App\Http\Controllers;

use App\Exports\EventExport;
use App\Models\Dropdown_option;
use App\Models\Event;
use App\Models\Film;
use App\Models\Participant;
use App\Models\Setting;
use DB;
use Excel;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EventController extends Controller
{
    public function events_index()
    {
        return Inertia::render('Backend/Events/Index');
    }

    public function events_add()
    {
        return Inertia::render('Backend/Events/Create');
    }

    public function events_edit($id)
    {
        return Inertia::render('Backend/Events/Update', [
            'eventId' => $id,
        ]);
    }

    public function events_fetch(Request $request)
    { 
        $events = Event::orderBy('start_date', 'desc')->paginate(50);
        

        $events_ids = $events->pluck('id');

        return [
            'events' => $events,
            'events_ids' => $events_ids,
        ];
        return $events;
    }
    public function active_events_fetch(Request $request)
    {
        $events = Event::where('status', 'true')->orderBy('start_date', 'desc')->get();
        foreach($events as $event)
        {
            $event->image = get_storage_url($event->image);
        }
        return $events;
    }
    public function calendar_events_fetch(Request $request)
    {
        $events = [];
        foreach (Event::all() as $key => $value) {
            $events[] = [
                'title' => $value['title'],
                'date' => $value['start_date'],
                'id' => $value['id'],
            ];
        }
        return $events;
    }

    public function calendar_events_store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            "end_date" => 'required|date|date_format:Y-m-d|after:start_date',
            'status' => 'required',
            'description' => 'required',
            'eligibility' => 'required',
            'image' =>   'nullable|image', 
            'catalog' => "nullable|mimes:pdf|max:10000",

        ]);
// dd($request);
        $event = new Event;
        $event->id = Str::orderedUuid();
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->eligibility = $request->eligibility;
        $event->status = $request->status;
        if ($request->file('image')) {
            $event->image = $request->file('image')->store('Event_Image');
        }
        if ($request->file('catalog')) {
            $event->catalog = $request->file('catalog')->store('Event_Catalogs');
        }
        
        $event->save();

        return 'success';
    }

    public function events_delete($id)
    {
        $event = Event::findOrFail($id);
        Storage::delete($event->image);
        Storage::delete($event->catalog);
        $event->delete();

        return 'success';
    }
    public function events_image_delete($id)
    {
        $event = Event::findOrFail($id);
        Storage::delete($event->image);
        $event->image = null;
        $event->save();

        return 'success';
    }
    public function events_catalog_delete($id)
    {
        $event = Event::findOrFail($id);
        $event->catalog = '';
        Storage::delete($event->catalog);
        $event->save();

        return 'success';
    }

    public function events_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            "end_date" => 'required|date|date_format:Y-m-d|after:start_date',
            'description' => 'required',
            'eligibility' => 'required',
            'status' => 'required',
            'image' =>   'nullable|image', 
            'catalog' => "nullable|mimes:pdf|max:10000",
        ]);

        $event = Event::findOrFail($request->id);
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->eligibility = $request->eligibility;
        $event->status = $request->status;
        if ($request->file('image')) {
            Storage::delete($event->image);
            $event->image = $request->file('image')->store('Event_Image');
        }
        if ($request->file('catalog')) {
            Storage::delete($event->catalog);
            $event->catalog = $request->file('catalog')->store('Event_Catalogs');
        }
        $event->save();

        return 'success';
    }

    public function calendar_events_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

        ]);
        $CalenderEvent = Event::findOrFail($request->id);
        $CalenderEvent->title = $request->title;
        $CalenderEvent->save();

        return 'success';
    }

    public function events_show($id)
    {
        $event = Event::findOrFail($id);
        $event->image = get_storage_url($event->image);
        $event->catalog = get_storage_url($event->catalog);
        return $event;
    }

    public function index()
    {
        return Inertia::render('Backend/Events/Calendar');
    }
    public function events()
    {
        $events = [];
        foreach (Event::all() as $key => $value) {

            $events[] = [
                'title' => $value['title'],
                'date' => $value['start'],
                'id' => $value['id'],
            ];
        }

        return $events;
    }

    public function event_process(Request $request)
    {
        if ($request->DataStatus == 'Create') {
            $CalenderEvent = new Event;
        
            $CalenderEvent->id = Str::orderedUuid();
            $CalenderEvent->event_id = $request->event_id;
            $CalenderEvent->title = $request->title;
            $CalenderEvent->start = $request->start;
            $CalenderEvent->end_date = $request->end_date;
            $CalenderEvent->all_day = $request->all_day;
            $CalenderEvent->save();
        } else if ($request->DataStatus == 'Update') {

        }
        return 'success';

    }
    public function delete($id)
    {
        $CalenderEvent = Event::findOrFail($id);
        Storage::delete($CalenderEvent->image);
        Storage::delete($CalenderEvent->catalog);
        $CalenderEvent->delete();

        return 'success';

    }
    public function update(Request $request)
    {
        $CalenderEvent = Event::findOrFail($request->id);
        $CalenderEvent->title = $request->title;
        $CalenderEvent->save();

        return 'success';
    }

    // public function role_registration(Request $request)
    // {
    //     dd($request);
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'role' => 'required',
    //         'email' => 'required',
    //     ]);
    //     $event_selected_role = Dropdown_option::where('id', $request->role)->first();

    //     $participant_apply = new Participant;
    //     $participant_apply->id = Str::orderedUuid();
    //     $participant_apply->event_id = $request->eventRegId;
    //     $participant_apply->participant_name = $request->name;
    //     $participant_apply->email = $request->email;
    //     $participant_apply->role = $request->role;
    //     $participant_apply->save();

    //     $url = url('/');
    //     $token = Str::random(64);
    //     $link = $url . '/get-talent-info/' . $token . '?email=' . urlencode($request->email) . '&participant_id=' . $participant_apply->id . '&name=' . urlencode($request->name) . '&eventRegId=' . $request->eventRegId . '&eventStartDate=' . $request->eventStartDate . '&eventTitle=' . $request->eventTitle . '&eventEndDate=' . $request->eventEndDate . '&role=' . $request->role;
    //     $website_name = Setting::where('type', 'website_name')->first();

    //     $dataforEmail = [
    //         'verify_email_for_role' => $link,
    //         'Name' => $request->name,
    //         'Role' => $event_selected_role->option_value,
    //         'eventTitle' => $request->eventTitle,
    //         'website_name' => $website_name->value,
    //     ];

    //     $user_email = $request->email;

    //     $mail_subject = 'Film Festival confirmation email.';

    //     Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

    //         $message->to($user_email)->subject($mail_subject);

    //     });

    //     return 'success';

    // }
    public function role_registration(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required',
        ]);
        // $event_selected_role = Dropdown_option::where('id', $request->role)->first();

        $participant_apply = new Participant;
        $participant_apply->id = Str::orderedUuid();
        $participant_apply->event_id = $request->eventRegId;
        $participant_apply->participant_name = $request->name;
        $participant_apply->email = $request->email;
        $participant_apply->role = $request->role;
        $participant_apply->save();

         

        return 'success';

    }

    public function get_talent_info(Request $request)
    {
        $seo = DB::table('seo')->first();

        $event_selected_role = Dropdown_option::where('id', $request->role)->first();
        if ($event_selected_role->option_value == 'Film Director') {
            $event_role = $request->name;
        } else {
            $event_role = '';
        }
        return Inertia::render('StepperForm', [
            'message' => "Please enter you information correctly in this form.",
            'email' => $request->email,
            'applied_by_name' => $request->name,
            'eventId' => $request->eventRegId,
            'eventTitle' => $request->eventTitle,
            'eventStartDate' => $request->eventStartDate,
            'participant_id' => $request->participant_id,
            'eventEndDate' => $request->eventEndDate,
            'role' => $event_role,
            'seo' => $seo,
        ]);

    }

    public function participant_store(Request $request)
    {

        $request->validate([
            // 'title' => 'required|string|max:255',
            "name" => "required",
            "email" => "required",
            "eventId" => "required",
            "eventTitle" => "required",
            "eventStartDate" => "required",
            "eventEndDate" => 'required|date|date_format:Y-m-d|after:eventStartDate',

        ]);

        $participant_apply = new Participant;
        $participant_apply->id = Str::orderedUuid();
        $participant_apply->event_id = $request->eventId;
        $participant_apply->participant_name = $request->name;
        $participant_apply->role = $request->role;
        $participant_apply->status = 1;
        $participant_apply->save();

        $website_name = Setting::where('type', 'website_name')->first();

        $dataforEmail = [
            'eventTitle' => $request->eventTitle,
            'Role' => $request->role,
            'website_name' => $website_name->value,
        ];

        $user_email = $request->email;

        $mail_subject = 'Applied for an event successfully.';

        Mail::send('Emails.mail', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

            $message->to($user_email)->subject($mail_subject);

        });

        return 'success';

    }

    public function events_details($id)
    {
        return Inertia::render('Backend/Events/Details', [
            'eventId' => $id,
        ]);
    }
    public function event_details_fetch($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $event->image = get_storage_url($event->image);
        $event->catalog = get_storage_url($event->catalog);
    //     $participants = Participant::where('event_id', $event->id)->get();
    //     foreach ($participants as $key => $participant) {
    //         $film = Film::find($participant->film_id);
    //         if ($film) {
    //             $dropdown_option = Dropdown_option::where('id',$film->type)->first();
    //             $film->type = $dropdown_option->option_value ?? '';
    //             $participant->film = $film;
    //         }else{
    //             unset($participants[$key]);
    //         }
    //     } 
    //     $selected_participants = $participants->where('status', 'Select');
    //     $participants = $participants->where('status', '!=', 'Select');

    //     return ['event' => $event, 'participants' => $participants, 'selected_participants' => $selected_participants];
    // $Participants = DB::table('participants')
    // ->join('films','films.id','=','participants.film_id') 
    // ->where('participants.event_id', $event->id)
    // ->select('participants.*','films.type','films.director','films.original_title','films.length','films.id as film_id')
    // ->orderBy('films.original_title','ASC')->get();
  
    // if($Participants)
    // {
    //     foreach ($Participants as $key => $participant) { 
    
    //         $dropdown_option = Dropdown_option::where('id',$participant->type)->first();
    //         $participant->type = $dropdown_option->option_value ?? ''; 
            
    //     }
    // } 
 
    // $selected_participants = $Participants->where('status', 'Select');
    // $Participants = $Participants->where('status', '!=', 'Select');

    // return ['event' => $event, 'Participants' => $Participants, 'selected_participants' => $selected_participants];
 return $event;
}

    public function success_message()
    {
        return Inertia::render('Success');

    }
    public function events_search(Request $request)
    {
        //  dd($request);
        $events = DB::table('events');
        if ($request->title) {
            $events->where(
                'title',
                'LIKE',
                '%' . $request->title . '%',
            );
        }

        $events = $events->orderBy('start_date', 'desc')->paginate(50);
        
        $events_ids = $events->pluck('id');

        return [
            'events' => $events,
            'events_ids' => $events_ids,
        ];

    }

    public function events_download(Request $request)
    {
        $events = Event::whereIn('id', $request)->get();

        foreach ($events as $event) {

            $participant_records = Participant::where('event_id', $event->id)->get();

            foreach ($participant_records as $participant_record) {
                $participant_record->participant_name = $participant_record->participant_name;

                $films = Film::where('id', $participant_record->film_id)->first();
                if ($films) {
                    $participant_record->film_name = $films->original_title;
                    $participant_record->type = $films->type;
                    $participant_record->length = $films->length;
                    $participant_record->length = $films->length;
                }
            }
            $event->participant_records = $participant_records;
        }

        $storage_path = 'Excel';
        $Name = "Events";
        File::delete($storage_path . '/' . $Name . '.xlsx');

        Excel::store(new EventExport($events), $storage_path . '/' . $Name . '.xlsx', 'real_public');
        $excelfile = $storage_path . '/' . $Name . '.xlsx';
        return $excelfile;
    }
    public function frontend_catalogs_fetch()
    {
        $current_date = date('Y-m-d');
        $catalogs = Event::where('end_date', '<', $current_date)->orderBy('start_date', 'asc')->get();
        $catalogs->catalog = get_storage_url($catalogs->catalog);
        return $catalogs;
    }
    public function status_changer(Request $request)
    {
        $event = Event::where('id', $request->event_id)->first();

        $event->status = $request->status;
        $event->save();
    }
    // this events_fetch_film_index method is for film index page event apply.
    public function events_fetch_film_index(Request $request)
    {
        $event = Event::pluck('title', 'id');

        return $event;
    }
}
