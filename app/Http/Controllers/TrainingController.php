<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Training;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App;
use PDF;


class TrainingController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Training/Index');
    }

    public function trainings(Request $request){        
        
        $trainings = Training::all();   
        return $trainings;

    }
    public function trainings_for_certificates(Request $request){        
        
        return Inertia::render('Backend/Training/Trainings_for_certificates');
        
    }
    public function trainings_for_certificates_details_fetch($id){        
        $trainings = Training::where('id',$id)->first();   
      
        return $trainings;

    }
    public function trainings_for_certificates_details($id){       
         
        
        return Inertia::render('Backend/Training/Trainings_for_certificates_details',['trainingId'=>$id]);

    }

    public function add(){

        return Inertia::render('Backend/Training/Create');
    }

     public function edit($id){
         
        return Inertia::render('Backend/Training/Update',[
            'trainingId' => $id
        ]);
    } 

    public function store(Request $request){
         
        $request->validate([
            'company' => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'date'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',      
            'assigned_trainer'  => 'required|string|max:255',      
            'certificate'  => 'required|string|max:255',      
            'status'  => 'required|string|max:255',      
        ]);
         
          
            $Training = new Training;
            $Training->id = Str::orderedUuid();
            $Training->company = $request->company;
            $Training->date = $request->date;
            $Training->city = $request->city;
            $Training->country = $request->country;
            $Training->assigned_trainer = $request->assigned_trainer;
            $Training->certificates = $request->certificate;
            $Training->status = $request->status;
         
            $Training->save();
 

            return back(303);
    }


    public function show($id){
        $Companies = Training::findOrFail($id); 
        return $Companies;
    }

    public function update(Request $request){
        $request->validate([
            'company' => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'date'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',      
            'assigned_trainer'  => 'required|string|max:255',      
            'certificate'  => 'required|string|max:255',      
            'status'  => 'required|string|max:255',      
        ]);
          
            $Training = Training::findOrFail($request->id);
            $Training->company = $request->company;
            $Training->date = $request->date;
            $Training->city = $request->city;
            $Training->country = $request->country;
            $Training->assigned_trainer = $request->assigned_trainer;
            $Training->certificates = $request->certificate;
            $Training->status = $request->status;
              
            $Training->save();
 

            return back(303);
 
    }


    public function delete($id){ 
        $Training = Training::findOrFail($id); 
        $Training->delete();

        return back(303);
    }

     
    // public function countries_pluck(){
    //     $country = Country::pluck('name','id');
    //     return $country;
    // }
 
    // public function states_pluck($country_id){
    //     $states = State::where('country_id',$country_id)->pluck('name','id');
    //     return $states;
    // }
    // public function cities_pluck($state_id){
    //     $cities = City::where('state_id',$state_id)->pluck('name','id');
        
    //     return $cities;
    // }
   


   
    public function createCertificatePDF($id) {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        
        $trainings = Training::where('id',$id)->first();   
         
        
        // $pdf = PDF::loadView('itemPdfView',$trainings->toArray());
        $pdf = PDF::loadView('itemPdfView', compact('trainings'));
        return $pdf->download('invoice.pdf');


         
      }

      public function pdfTrainings()
    {
         
        $pdf = public_path('pdf/test.pdf');
        return response()->download($pdf);
    }
      public function pdf()
    {
         
        $filePath = public_path("dummy.pdf");
    	$headers = ['Content-Type: application/pdf'];
    	$fileName = time().'.pdf';

    	return response()->download($filePath, $fileName, $headers);
    }

    

     
}
