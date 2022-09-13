<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::orderBy('priority', 'asc')->get();
        $projects = Project::hasTasks()->get();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'       => 'required',
            'user_id'    => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $maxPrioroty = Task::max('priority') ?: 0;

        $newTask             = new Task();
        $newTask->name       = $request->name;
        $newTask->project_id = $request->project_id;
        $newTask->priority   = ++$maxPrioroty;

        $newTask->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task     = Task::findOrFail($id);
        $projects = Project::all();
        $users    = User::all();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task     = Task::findOrFail($id);
        $request->validate([
            'name'       => 'required',
            'user_id'    => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $task->name       = $request->name;
        $task->user_id    = $request->user_id;
        $task->project_id = $request->project_id;

        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task     = Task::findOrFail($id);
        Task::where('priority', '>', $task->priority)
            ->update(['priority' => \DB::raw('priority - 1')]);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiSetPriority(Request $request){

        $task = Task::findOrFail($request->input('task_id'));
        $prev = Task::find( $request->input('prev_id') );

        if( !$request->input('prev_id') ){
            $destination = 1;
        }else if( !$request->input('next_id') ){
            $destination = Task::count();
        }else{
            $destination = $task->priority < $prev->priority ? $prev->priority : $prev->priority + 1;
        }

        Task::where('priority', '>', $task->priority)
            ->where('priority', '<=', $destination)
            ->update(['priority' => \DB::raw('priority - 1')]);

        Task::where('priority', '<', $task->priority)
            ->where('priority', '>=', $destination)
            ->update(['priority' => \DB::raw('priority + 1')]);

        $task->priority = $destination;
        $task->save();

        return response()->json(true);
    }
}
