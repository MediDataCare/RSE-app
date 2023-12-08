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
}
