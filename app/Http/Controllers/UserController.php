<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function indexUsers(){
        return view('backend.users.table');
    }

    public function showUser($userId){
        $user = User::find($userId);
        return view('backend.users.show-user', ['user' => $user, 'action' => 'show']);
    }

    public function editUserRole($id){
        $user = User::find($id);
        return view('backend.users.edit-user', ['user' => $user, 'action' => 'edit']);
    }

    public function updateUserRole($id, Request $request)
    {
        $new_role = $request->input('new_role');
       

        User::where('id', $id)
        ->update(['data->role' => $new_role]);

    

        return redirect()->action([UserController::class, 'indexUsers']);
    }

}
