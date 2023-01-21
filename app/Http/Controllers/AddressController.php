<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Address/Index');
    }

    public function addresses(Request $request){        
        
        $addresses = Address::all();

        foreach($addresses as $address){

            $country = Country::where('id',$address->country)->first();
            if($country){
                    $address->country = $country->name;
                }else{
                    $address->country = "No Cuntry Added";
                }
                
            $state = State::where('id',$address->state)->first();
            if($state){ 
                    $address->state = $state->name;
                }else{
                    $address->state = "No Province Added";
                }

            $city = City::where('id',$address->city)->first();
            if($city){
                    $address->city = $city->name;
                }else{
                    $address->city = "No Province Added";
                }
                $addresses->address = $address;    
            }
             
        return $addresses;

    }

    public function add(){

        return Inertia::render('Backend/Address/Create');
    }

     public function edit($id){
         
        return Inertia::render('Backend/Address/Update',[
            'addressId' => $id
        ]);
    } 

    public function store(Request $request){
         
        $request->validate([
             
            'street' => 'required|string|max:255',
            'street2'  => 'required|string|max:255',
            'apt'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'zip'  => 'required|string|max:255',      
            'xx'  => 'required|string|max:255',      
        ]);
          
            $Address = new Address;
            $Address->id = Str::orderedUuid();
            $Address->street = $request->street;
            $Address->street2 = $request->street2;
            $Address->apt = $request->apt; 
            $Address->country = $request->country;
            $Address->state = $request->state;
            $Address->city = $request->city;
            $Address->zip = $request->zip;
            $Address->xx = $request->xx;
              
            $Address->save();
 

            return back(303);
    }


    public function show($id){
        $Addresses = Address::findOrFail($id); 
        return $Addresses;
    }

    public function update(Request $request){
        $request->validate([
             
            'street' => 'required|string|max:255',
            'street2'  => 'required|string|max:255',
            'apt'  => 'required|string|max:255',
            'country'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'zip'  => 'required|string|max:255',      
            'xx'  => 'required|string|max:255',      
        ]);
          
            $Address = Address::findOrFail($request->id);
            $Address->street = $request->street;
            $Address->street2 = $request->street2;
            $Address->apt = $request->apt; 
            $Address->country = $request->country;
            $Address->state = $request->state;
            $Address->city = $request->city;
            $Address->zip = $request->zip;
            $Address->xx = $request->xx;
              
            $Address->save();
 

            return back(303);
 
    }


    public function delete($id){ 
        $Address = Address::findOrFail($id); 
        $Address->delete();

        return back(303);
    }

    public function addresses_pluck(){
        $addresses = Address::pluck('name','id');
        return $addresses;
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
