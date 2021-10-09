<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = Todo::all();
        return view('todo.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $path = $request->file('image')->store('images/todos');
        // if($request->hasFile('image')){
        //     $path = $request->file('image')->store('images/todos');
        // }
        
        // $todo = Todo::create($request->array());
        $todo = Todo::create([
            'task' => $request->get('task'),
            'image' => $path,
        ]);
        if(empty($todo)){
            return redirect()->back()->withInput();
        }
        return redirect()->route('todos.index')->with('SUCCESS',__("Todo Has Been Created Successfully"));
    }

    /**
     * Complete the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function complete(Todo $todo)
    {
        $todo->forceFill([
                "is_complete" => true
        ]);
        if($todo->update()){
            return redirect()->route("todos.index")->with("SUCCESS", __("This Task Has Been Completed Successfully"));
        }
        return redirect()->back()->withInput("ERROR", __("Failed To Update"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $data['todo'] = $todo;
        return view("todo.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->task = $request->get('task');
        if($request->hasFile('image')){
            $todo->image = $request->file('image')
            ->store('images/todos');
        }
        if($todo->update()){
            return redirect()->route("todos.index")->with("SUCCESS", __("The Task Has Been Updated Successfully"));
        }
        return redirect()->back()->withInput("ERROR", __("Failed To Update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $image = $todo->image;
        if(File::exists($image)){
            Storage::delete($image);
            // File::delete($image);
            // unlink($todo->image);
        }
        if($todo->delete()){
            return redirect()->back()->with("SUCCESS", __("The Task Has Been Deleted"));
        }
            return redirect()->back()->with("ERROR", __("Failed To Delete"));
    }
}
