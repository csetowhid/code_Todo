<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $data['list'] = Todo::select(['id','task'])->paginate(2);
        // $data['list'] = Todo::orderBy('id','desc')->paginate(2);
        // $data['list'] = Todo::latest()->paginate(2);
        // $data['list'] = Todo::limit(2)->get();
        // $data['list'] = Todo::offset(2)->limit(2)->get();
        // dd($data['list']->toArray());
        // $data['list']->dd();
        // $data['list']->dump();
        // $data['list'] = Todo::withTrashed()->paginate(2);
        // $data['list'] = Todo::onlyTrashed()->paginate();

        $data['list'] = Todo::with('Categories')->paginate(5);
        $data['users'] = User::count('id');
        $data['todos'] = Todo::count('id');
        $data['categories'] = Category::count('id');
        $data['comments'] = Comment::count('id');
        return view('todo.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::pluck('name','id');
        return view('todo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $path = "";
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images/todos');
        }
        
        // $todo = Todo::create($request->array());

        /*---------------------------*/
        // $todo = Todo::firstOrCreate([
        //     'task' =>$request->get('task')
        // ],
        // [
        //     'is_complete' =>true
        // ]);
        /*---------------------------*/
        // $path = $request->file('image')->store('images/todos');
        $todo = Todo::create([
            // 'category_id' => $request->get('category_id'),
            'task' => $request->get('task'),
            'description' => $request->get('description'),
            'image' => $path,
        ]);
        if(empty($todo)){
            return redirect()->back()->withInput();
        }
        $todo->categories()
        ->attach($request->get('categories'));
        return redirect()->route('dashboard')->with('SUCCESS',__("Todo Has Been Created Successfully"));
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
            return redirect()->route("dashboard")->with("SUCCESS", __("This Task Has Been Completed Successfully"));
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
        $data['categories'] = Category::pluck('name','id');
        return view("todo.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function show(Todo $todo)
    {
        $data['todo']=$todo;
        $data['comments']= Comment::where('todos_id',$todo->id)
                        // ->where('auth_id', Auth::id())
                        ->get();
        return view("comment.create", $data);
    }


    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->task = $request->get('task');
        $todo->description = $request->get('description');
        if($request->hasFile('image')){
            $todo->image = $request->file('image')
            ->store('images/todos');
        }
        if($todo->update()){
            $todo->categories()->sync($request->get('categories'));
            return redirect()->route("dashboard")->with("SUCCESS", __("The Task Has Been Updated Successfully"));
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
            // Storage::delete($image);
            // File::delete($image);
            // unlink($todo->image);
        }
        if($todo->delete()){
            return redirect()->back()->with("SUCCESS", __("The Task Has Been Deleted"));
        }
            return redirect()->back()->with("ERROR", __("Failed To Delete"));
    }
}
