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
    public function create(Request $request) 
    {
        $pageTitle = 'Create Task';
        $status = $request->status;
        return view('tasks.create', [
            'pageTitle' => $pageTitle, 'status' =>$status
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
    public function progress()
{
    $title = 'Task Progress';

    $allTasks = Task::all();

    $filteredTasks = $allTasks->groupBy('status');

    $tasks = [
        Task::STATUS_NOT_STARTED => $filteredTasks->get(Task::STATUS_NOT_STARTED, []),
        Task::STATUS_IN_PROGRESS => $filteredTasks->get(Task::STATUS_IN_PROGRESS, []),
        Task::STATUS_IN_REVIEW => $filteredTasks->get(Task::STATUS_IN_REVIEW, []),
        Task::STATUS_COMPLETED => $filteredTasks->get(Task::STATUS_COMPLETED, []),
    ];
   
    return view('tasks.progress', [
        'pageTitle' => $title,
        'tasks' => $tasks,
    ]);
}

public function move(int $id, Request $request)
{
         $task = Task::findOrFail($id);

         $task->update([
        'status' => $request->status,
       
    ]);
                                                                             
    return redirect()->route('tasks.progress');

   
}


    public function complete($id) 
    {
        $task = Task::finOrFail($id);

        $task->update([
            'status' =>'completed'          
        ]);
        return redirect()->route('tasks.index');
 
    }

}
