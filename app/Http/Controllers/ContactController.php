<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Contact/Index');
    }

    public function add(){
        return Inertia::render('Backend/Contact/Create');
    }

     public function edit($id){
        return Inertia::render('Backend/Contact/Update',[
            'contactId' => $id
        ]);
    }

     public function contacts(Request $request){        
       
        $contacts = Contact::all();
        return $contacts;

    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'contact_type'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date'       => 'required',      
        ]);
          
            $Contact = new Contact;
            $Contact->id = Str::orderedUuid();
            $Contact->type = $request->contact_type;
            $Contact->description = $request->description;
            $Contact->date = $request->date;
              
            $Contact->save();

            return back(303);
    }


    public function show($id){
        $Contacts = Contact::findOrFail($id);
        return $Contacts;
    }

    public function update(Request $request){
        $request->validate([
            'contact_type'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date'       => 'required',      
        ]);
 
        $Contact = Contact::findOrFail($request->id);
        $Contact->type = $request->contact_type;
        $Contact->description = $request->description;
        $Contact->date = $request->date;

        $Contact->save();

        return back(303);
    }


    public function delete($id){
        
        $Contact = Contact::findOrFail($id); 
        $Contact->delete();

        return back(303);
    }
}
