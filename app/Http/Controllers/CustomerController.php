<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Company;
 
 
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Customer/Index');
    }

    public function customers(Request $request){        
        
        $customers = Customer::all();

        foreach($customers as $customer){

            $company = Company::where('id',$customer->company)->first();
            if($company){
                    $customer->company = $company->name;
                }else{
                    $customer->company = "No Company Added";
                }
                
                $customers->company = $customers;
        } 
        return $customers;

    }

    public function add(){

        return Inertia::render('Backend/Customer/Create');
    }

     public function edit($id){
         
        return Inertia::render('Backend/Customer/Update',[
            'customerId' => $id
        ]);
    } 

    public function store(Request $request){ 
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'dob'  => 'required|string|max:255',
            'email'  => 'required|unique:customers',
            'phone'  => 'required|string|max:255',
            'phone2'  => 'required|string|max:255',
            'allergies'  => 'required|string|max:255',      
            'activity'  => 'required|string|max:255',      
            'company'  => 'required',      
        ]);
            $Customer = new Customer;
            $Customer->id = Str::orderedUuid();
            $Customer->first_name = $request->first_name;
            $Customer->last_name = $request->last_name;
            $Customer->dob = $request->dob;
            $Customer->email = $request->email;
            $Customer->phone = $request->phone;
            $Customer->phone2 = $request->phone2;
            $Customer->allergies = $request->allergies;
            $Customer->activity = $request->activity;
            $Customer->company = $request->company;
              
            $Customer->save();
 

            return back(303);
    }


    public function show($id){ 
        $Customer = Customer::findOrFail($id); 
        return $Customer;
    }

    public function update(Request $request){
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'dob'  => 'required|string|max:255',
             
            'email' => "required|unique:customers,email,{$request->id}",
            'phone'  => 'required|string|max:255',
            'phone2'  => 'required|string|max:255',
            'allergies'  => 'required|string|max:255',      
            'activity'  => 'required|string|max:255',      
            'company'  => 'required',      
        ]);
          
            $Customer = Customer::findOrFail($request->id);
            $Customer->first_name = $request->first_name;
            $Customer->last_name = $request->last_name;
            $Customer->dob = $request->dob;
            $Customer->email = $request->email;
            $Customer->phone = $request->phone;
            $Customer->phone2 = $request->phone2;
            $Customer->allergies = $request->allergies;
            $Customer->activity = $request->activity;
            $Customer->company = $request->company;
              
            $Customer->save();
            return back(303);
 
    }


    public function delete($id){ 
        $Customer = Customer::findOrFail($id); 
        $Customer->delete();

        return back(303);
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
}
