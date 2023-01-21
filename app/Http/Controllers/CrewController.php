<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Crew;
use Illuminate\Support\Str;

class CrewController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Crew/Index');
    }

    public function add(){
        return Inertia::render('Backend/Crew/Create');
    }

     public function edit($id){
        return Inertia::render('Backend/Crew/Update',[
            'crewId' => $id
        ]);
    }

     public function crews(Request $request){        
        
        $crews = Crew::all();
        return $crews;

    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'name'       => 'required|string|max:255',
            'phone'       => 'required|string|max:255',
            'email'       => 'required|string|max:255|email',      
        ]);
          
            $Crew = new Crew;
            $Crew->id = Str::orderedUuid();
            $Crew->name = $request->name;
            $Crew->phone = $request->phone;
            $Crew->email = $request->email;
              
            $Crew->save();

            return back(303);
    }


    public function show($id){
        $Crews = Crew::findOrFail($id);
        return $Crews;
    }

    public function update(Request $request){
          $request->validate([
            'name'       => 'required|string|max:255',
            'phone'       => 'required|string|max:255',
            'email'       => 'required|string|max:255|email', 
                  
        ]);
          

        $Crew = Crew::findOrFail($request->id);
        $Crew->name = $request->name;
        $Crew->phone = $request->phone;
        $Crew->email = $request->email;

        $Crew->save();

        return back(303);
    }


    public function delete($id){
        
        $Crew = Crew::findOrFail($id); 
        $Crew->delete();

        return back(303);
    }
}
