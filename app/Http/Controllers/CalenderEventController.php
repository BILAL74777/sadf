<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CalenderEvent;


class CalenderEventController extends Controller
{
    function index(){
        return Inertia::render('Backend/Chart/Calender');
    }
    function events(){
        // dd('coming nere');
        // return ;
        $events = [];
        foreach (CalenderEvent::all() as $key => $value) {
            // dd($value['title']);
            // start
            $events[] = [
                'title' => $value['title'],
                'date' => $value['start'],
                'id' => $value['id'],   
            ];
        }

        return $events;
        // events: [
        //   { title: 'event 1', date: '2022-07-13' },
        //   { title: 'event 2', date: '2022-07-20' }
        // ],
    }

    public function event_process(Request $request)
    { 
            // dd($request);
            if($request->DataStatus == 'Create'){ 
            $CalenderEvent = new CalenderEvent;
            $CalenderEvent->event_id  =  $request->event_id;
            $CalenderEvent->title  =     $request->title;
            $CalenderEvent->start  =     $request->start;
            $CalenderEvent->end_date  =  $request->end_date;
            $CalenderEvent->all_day  =  $request->all_day;
            $CalenderEvent->save();
        }else if($request->DataStatus == 'Update')
        { 
        

        }
            return 'success';

    }
    public function delete($id)
    { 
        $CalenderEvent = CalenderEvent::findOrFail($id); 
        $CalenderEvent->delete();

        return back(303);
        
        
    }
    public function update(Request $request)
    {
        $CalenderEvent = CalenderEvent::findOrFail($request->id); 
        $CalenderEvent->title  =  $request->title;
        $CalenderEvent->save();
         
        return back(303);
    }
}
