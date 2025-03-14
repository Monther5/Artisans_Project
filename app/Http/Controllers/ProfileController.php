<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Requests\StoreProfileRequest;
use App\Models\Task;

class ProfileController extends Controller
{
    
    public function index()
    {
        return response()->json('Profile', 200);
    }
    public function show($id)
    {
        $data = Profile::where('user_id',$id)->firstOrFail();
        return response()->json($data, 200);
    }
    public function store(StoreProfileRequest $request)
    {
        $UserId=Auth::user()->id;
        $request->validated()['user_id']=$UserId;
       $validated= $request->validated();
       if($request->hasFile('profile_picture')){
$path=$request->file('profile_picture')->store('my picture','public'); 

$validated['profile_picture']=$path;
}
        $data=  Profile::create($validated);

        return response()->json($data, 201);
    }
    public function update(StoreProfileRequest $request, $id)
    {
        $data = Profile::where('user_id',$id)->firstOrFail();
        $data->update($request->validated());
        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $data = Profile::where('user_id',$id)->firstOrFail();
        $data->delete();
        return response()->json('Profile deleted', 200);
    }
}
