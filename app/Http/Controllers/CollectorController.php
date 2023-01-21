<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Collector;
use App\Models\Setting;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CollectorController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Collector/Index');
    }

    public function collectors(Request $request){        
        
        $collectors = Collector::all();   
        return $collectors;

    }

    public function add(){

        return Inertia::render('Backend/Collector/Create');
    }

     public function edit($id){
         
        return Inertia::render('Backend/Collector/Update',[
            'collectorId' => $id
        ]);
    } 

    public function store(Request $request){
         
        $request->validate([
            'company' => 'required|string|max:255',
            'amount'  => 'required|string|max:255',
            'date'  => 'required|string|max:255',
            'status'  => 'required|string|max:255',      
        ]);
          
            $Collector = new Collector;
            $Collector->id = Str::orderedUuid();
            $Collector->company = $request->company;
            $Collector->amount = $request->amount;
            $Collector->dates = $request->date;
            $Collector->status = $request->status;
         
            $Collector->save();
 

            return back(303);
    }


    public function show($id){
        $Companies = Collector::findOrFail($id); 
        return $Companies;
    }

    public function update(Request $request){
        $request->validate([
            'company' => 'required|string|max:255',
            'amount'  => 'required|string|max:255',
            'date'  => 'required|string|max:255',
            'status'  => 'required|string|max:255',      
        ]);
          
            $Collector = Collector::findOrFail($request->id);
            $Collector->company = $request->company;
            $Collector->amount = $request->amount;
            $Collector->dates = $request->date;
            $Collector->status = $request->status;
              
            $Collector->save();
 

            return back(303);
 
    }


    public function delete($id){ 
        $Collector = Collector::findOrFail($id); 
        $Collector->delete();

        return back(303);
    }

    public function companies_pluck(){
        $collectors = Collector::pluck('name','id');
        return $collectors;
    }
    public function countries_pluck(){
        $country = Country::pluck('name','id');
        return $country;
    }
 
    public function states_pluck($country_id){
        $states = State::where('country_id',$country_id)->pluck('name','id');
        return $states;
    }
    public function cities_pluck($state_id){
        $cities = City::where('state_id',$state_id)->pluck('name','id');
        
        return $cities;
    }
   


    public function submit_order(Request $request, $amount,$company,$collection_id, $status, $email, $name, $payer_id, $trans_id){
    
         
        $Payment = new Payment;
        $Payment->id = Str::orderedUuid();;
         
        
        $Payment->amount = $amount;
        $Payment->company = $company;
        $Payment->collection_id = $collection_id; 

        $Payment->payment_status = $status;
        $Payment->code = date('Ymd-His').rand(10,99);
    
        $Payment->payment_method = 'Paypal';
        $Payment->paypal_email = $email;
        $Payment->paypal_name = $name;
        $Payment->paypal_payer_id = $payer_id;
        $Payment->paypal_transaction_id = $trans_id;
        
        $Payment->save();
        return Inertia::render('Backend/Collector/Index');
    }
    public function email_side_payment_submit(Request $request, $amount,$company,$collection_id, $status, $email, $name, $payer_id, $trans_id){
    
         
        $Payment = new Payment;
        $Payment->id = Str::orderedUuid();;
         
        
        $Payment->amount = $amount;
        $Payment->company = $company;
        $Payment->collection_id = $collection_id; 

        $Payment->payment_status = $status;
        $Payment->code = date('Ymd-His').rand(10,99);
    
        $Payment->payment_method = 'Paypal';
        $Payment->paypal_email = $email;
        $Payment->paypal_name = $name;
        $Payment->paypal_payer_id = $payer_id;
        $Payment->paypal_transaction_id = $trans_id;
        
        $Payment->save();
        return Inertia::render('Backend/PayPallSuccess', [
            'message' => "Payment Done Successfully.",  
        ]); 
    }


    public function collection_email_send($collection_id){
        $collection = Collector::where('id',$collection_id)->first();
 
        $url = url('/');
         $token = Str::random(64);
         $link = $url . '/check-company/' . $collection->id;
        

        // process for customize email sending...
        $Email = Setting::where('type', 'collection_email_section')->first();
        if($Email)
        {
            $email_record = json_decode($Email->value);

            $email_description = $email_record[0]->description;
            $company = $collection->company;
            $amount = $collection->amount;
            
            $amount_var = array('${AMOUNT}');
            $amount_array =  array($amount);
            $company_var = array('${COMPANY}');
            $company_array = array($company);
        
            $adjusted_amount = str_replace($amount_var, $amount_array, $email_description);
            $customised_email = str_replace($company_var, $company_array, $adjusted_amount);
             
        }
        $dataforEmail = [
            'email_send' => $link, 
            'customised_email' => $customised_email, 
        ];

        // $user_email = $request->email;
        $user_email = 'billhssn777@gmail.com';
        $mail_subject = 'This email has been sent from the system.';

        
        // return view('emails.schedule_tasks', compact('user', 'events_and_tasks'));
        Mail::send('Emails.collection-email', $dataforEmail, function ($message) use ($user_email, $mail_subject) {

            $message->to($user_email)->subject($mail_subject);

        });
        
        return Inertia::render('Backend/Collector/Index', [
            'message' => "Email Sent Successfully.",  
        ]);
         
    }

    public function check_company($request)
    {
        $collection = Collector::where('id',$request)->first();
        return Inertia::render('Backend/Collector/PayPal_payment',[
            'amount' => $collection->amount,
            'company' => $collection->company,
            'collection_id' => $collection->id,

        ]);
    }

    function bilal()
    {
        $Email = Setting::where('type', 'collection_email_section')->first();
         
            $email_record = json_decode($Email->value);

            $email_description = $email_record[0]->description;
            $company = 'ABC Company';
            $amount = 123;
            
            $amount_var = array('${AMOUNT}');
            $amount_array =  array($amount);
            $company_var = array('${COMPANY}');
            $company_array = array($company);
        
            $adjusted_amount = str_replace($amount_var, $amount_array, $email_description);
            $customised_email = str_replace($company_var, $company_array, $adjusted_amount);
             
        //  dd($customised_email);
        
            $email_send =  'abc';
            $customised_email = $customised_email;
            return view('Emails.collection-email',compact('email_send','customised_email'));
        
    }
}
