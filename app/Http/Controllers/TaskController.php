<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(){
        return Inertia::render('Backend/Task/Index');
    }

    public function add(){
        return Inertia::render('Backend/Task/Create');
    }

     public function edit($id){
        return Inertia::render('Backend/Task/Update',[
            'taskId' => $id
        ]);
    }

     public function tasks(Request $request){        
       
        $tasks = Task::all();
        return $tasks;

    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'name'       => 'required|string|max:255',
            'due' => 'required|string|max:255',      
            'assign_to' => 'required|string|max:255',      
            'assign_by' => 'required|string|max:255',      
        ]);
          
            $Task = new Task;
            $Task->id = Str::orderedUuid();
            $Task->name = $request->name;
            $Task->due = $request->due;
            $Task->assign_to = $request->assign_to;
            $Task->assign_by = $request->assign_by;
              
            $Task->save();

            return back(303);
    }


    public function show($id){
        $Tasks = Task::findOrFail($id);
        return $Tasks;
    }

    public function update(Request $request){
        $request->validate([
            'name'       => 'required|string|max:255',
            'due' => 'required|string|max:255',      
            'assign_to' => 'required|string|max:255',      
            'assign_by' => 'required|string|max:255',      
        ]);
 
        $Task = Task::findOrFail($request->id);
        $Task->name = $request->name;
        $Task->due = $request->due;
        $Task->assign_to = $request->assign_to;
        $Task->assign_by = $request->assign_by;

        $Task->save();

        return back(303);
    }


    public function delete($id){
        
        $Task = Task::findOrFail($id); 
        $Task->delete();

        return back(303);
    }
}
