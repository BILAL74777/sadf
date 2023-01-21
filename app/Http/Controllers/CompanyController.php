<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Company/Index');
    }

    public function companies(Request $request){        
        
        $companies = Company::all();

        foreach($companies as $company){

            $country = Country::where('id',$company->country)->first();
            if($country){
                    $company->country = $country->name;
                }else{
                    $company->country = "No Cuntry Added";
                }
                
            $state = State::where('id',$company->state)->first();
            if($state){ 
                    $company->state = $state->name;
                }else{
                    $company->state = "No Province Added";
                }

            $city = City::where('id',$company->city)->first();
            if($city){
                    $company->city = $city->name;
                }else{
                    $company->city = "No Province Added";
                }
                $companies->address = $company;    
            }
             
        return $companies;

    }

    public function add(){

        return Inertia::render('Backend/Company/Create');
    }

     public function edit($id){
         
        return Inertia::render('Backend/Company/Update',[
            'companyId' => $id
        ]);
    } 

    public function store(Request $request){
         
        $request->validate([
             
            'name' => 'required|string|max:255',
            'rcu'  => 'required|string|max:255',
            'address'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'zip'  => 'required|string|max:255',      
        ]);
          
            $Company = new Company;
            $Company->id = Str::orderedUuid();
            $Company->name = $request->name;
            $Company->rcu = $request->rcu;
            $Company->address = $request->address;
            $Company->country = $request->country;
            $Company->state = $request->state;
            $Company->city = $request->city;
            $Company->zip = $request->zip;
              
            $Company->save();
 

            return back(303);
    }


    public function show($id){
        $Companies = Company::findOrFail($id); 
        return $Companies;
    }

    public function update(Request $request){
        $request->validate([
             
            'name' => 'required|string|max:255',
            'rcu'  => 'required|string|max:255',
            'address'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'zip'  => 'required|string|max:255',      
        ]);
          
            $Company = Company::findOrFail($request->id);
            $Company->name = $request->name;
            $Company->rcu = $request->rcu;
            $Company->address = $request->address;
            $Company->country = $request->country;
            $Company->state = $request->state;
            $Company->city = $request->city;
            $Company->zip = $request->zip;
              
            $Company->save();
 

            return back(303);
 
    }


    public function delete($id){ 
        $Company = Company::findOrFail($id); 
        $Company->delete();

        return back(303);
    }

    public function companies_pluck(){
        $companies = Company::pluck('name','id');
        return $companies;
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
