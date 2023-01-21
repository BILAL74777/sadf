<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Unit;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Unit/Index');
    }

    public function add(){
        return Inertia::render('Backend/Unit/Create');
    }

     public function edit($id){
        return Inertia::render('Backend/Unit/Update',[
            'unitId' => $id
        ]);
    }

     public function units(Request $request){        
       
        $units = Unit::all();
        return $units;

    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
             
            'type' => 'required',
            'model' => 'required',
            'version' => 'required',
            'year' => 'required',
            'max_speed' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'load' => 'required',
            'fuel' => 'required',
            'kilometer' => 'required',
            'height' => 'required',
            'lenght' => 'required',
        ]);
          
            $Unit = new Unit;
            $Unit->id = Str::orderedUuid();
            $Unit->type = $request->type;
            $Unit->model = $request->model;
            $Unit->version = $request->version;
            $Unit->year = $request->year;
            $Unit->max_speed = $request->max_speed;
            $Unit->weight = $request->weight;
            $Unit->color = $request->color;
            $Unit->load = $request->load;
            $Unit->fuel = $request->fuel;
            $Unit->kilometer = $request->kilometer;
            $Unit->height = $request->height;
            $Unit->lenght = $request->lenght;
              
            $Unit->save();

            return back(303);
    }


    public function show($id){
        $Tasks = Unit::findOrFail($id);
        return $Tasks;
    }

    public function update(Request $request){
        $request->validate([
             
            'type' => 'required',
            'model' => 'required',
            'version' => 'required',
            'year' => 'required',
            'max_speed' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'load' => 'required',
            'fuel' => 'required',
            'kilometer' => 'required',
            'height' => 'required',
            'lenght' => 'required',
        ]);
 
            $Unit = Unit::findOrFail($request->id);
            $Unit->type = $request->type;
            $Unit->model = $request->model;
            $Unit->version = $request->version;
            $Unit->year = $request->year;
            $Unit->max_speed = $request->max_speed;
            $Unit->weight = $request->weight;
            $Unit->color = $request->color;
            $Unit->load = $request->load;
            $Unit->fuel = $request->fuel;
            $Unit->kilometer = $request->kilometer;
            $Unit->height = $request->height;
            $Unit->lenght = $request->lenght;

        $Unit->save();

        return back(303);
    }


    public function delete($id){
        
        $Unit = Unit::findOrFail($id); 
        $Unit->delete();

        return back(303);
    }
}
