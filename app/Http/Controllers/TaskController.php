<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{

    public function index()
    {
        $data = Task::all();
        return response()->json($data, 200);
    }
    public function store(StoreTaskRequest $request)
    {
    
        $data = Task::create(
            $request->validated()
        );
        return response()->json($data, 201);
    }
    public function update(UpdateTaskRequest $request,$id)
    {
       

        $task= Task::findOrFail($id);
        $task ->update($request->validated());
            
        return response()->json($task, 200);
    }
    public function show($id){
        $task =Task::findOrFail($id);
        return response()->json($task, 200);

    }
    public function destroy($id)
    {

        $task= Task::findOrFail($id);
        $task ->delete();
            
        return response()->json($task, 204);
    }
    public function getTaskuser($id)
    {
        $user = Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }
    public function AddCategoryToTask( Request $request,$taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json('create sucfully ', 200);
    }


}
