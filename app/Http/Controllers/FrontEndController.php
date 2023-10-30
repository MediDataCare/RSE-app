<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontEndController extends Controller
{


    public function entitiesForm(){

        return view('frontend.entities.form');
    }

    public function entitiesProfile(){
        return view('frontend.entities.profile');
    }

    public function usersForm(){

        return view('frontend.users.form');
    }

    public function userProfile(){
        return view('frontend.users.profile');
    }

    public function entitie_store(Request $data)
    {
        //self::validator($data);
        //Passa a role no data. Se a role for igual a entitie então o estado é peding. Se for user o estado é accepted.
        //E guarda essa role no "data" => ['role' => data['role']
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'parameters' => [
                'file' => data_get($data, 'file'),
                'cae' => data_get($data, (int)'cae'),
            ],
            'data' => data_get($data, 'role')

        ]);
        return redirect()->route('homepage');
    }
}
