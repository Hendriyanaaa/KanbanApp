<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    

    public function __construct()
    {
       
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Task';

        $task = Task::find($id);

        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    }
    
    public function index()
    {
        $pageTitle = 'Task List';
        $tasks = Task::all();
        return view('tasks.index', [
            'pageTitle' => $pageTitle,
            'list'=>$tasks]);
    }
    public function create() 
    {
        $pageTitle = 'Task Create';
    
        return view('tasks.create', [
            'pageTitle' => $pageTitle,
            ]);
        
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],
            $request->all()
        );
        
        Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);
        return redirect()->route('tasks.index');
    }
    public function update($id, Request $request) {
        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],$request->all()
        );
        $task = Task::find($id);
        $task->update([ 
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,]);
            return redirect()->route('tasks.index');
    }
    public function delete($id) { 
        $pageTitle = 'Task delete';
        $task = Task::find($id);
        return view('tasks.delete', [
            'pageTitle' => $pageTitle,
            'task' => $task,
        ]);

    }
    public function destroy($id){
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');

    }
    
}
