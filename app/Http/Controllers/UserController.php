<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getProfile($id)
    {

        $user = User::find($id)->profile;
        return response()->json($user, 200);
        
    }
    public function getTask($id)
    {
        $user = User::find($id)->tasks;
        return response()->json($user, 200);
    }
}
