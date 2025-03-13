<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function getAllTask()
    {
        $tasks= Task::all();
        return response()->json($tasks, 200);
    }
    public function index()
    {
        $tasks= Auth::user()->tasks;


        return response()->json($tasks, 200);
    }
    public function OrderTaskByPriority()
    {
        $tasks= Task::user()->tasks()->orderByRaw("FIELD('priority','high,'mid','low')", )->get();
        return response()->json($tasks, 200);
    }
    public function store(StoreTaskRequest $request)
    {
        $user_id= Auth::user()->id;
      $validateddata=  $request->validated();
        $validateddata['user_id']=$user_id;
    
        $data = Task::create(
            $validateddata
        );
        return response()->json($data, 201);
    }
    public function update(UpdateTaskRequest $request,$id)
    {

        $user_id= Auth::user()->id;
       

        $task= Task::findOrFail($id);
        if($task->user_id != $user_id){
            return response()->json('you are not allowed to update this task', 403);
        }
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
        if(!Task::find($id)or Task::find($id)->user == null){
            return response()->json('task not found', 404);
        }
        $user = Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }
    public function AddCategoryToTask( Request $request,$taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json('create sucfully ', 200);
    }
    public function AddToFavorite($taskId)
    {
        $user_id= Auth::user()->id;
        $task = Task::findOrFail($taskId);
        $task->favorites()->attach($user_id);
        return response()->json('create sucfully ', 200);
    }
    public function RemoveFromFavorite($taskId)
    {
        $user_id= Auth::user()->id;
        $task = Task::findOrFail($taskId);
        $task->favorites()->detach($user_id);
        return response()->json('delete sucfully ', 200);
    }


}
