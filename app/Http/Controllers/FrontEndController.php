<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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
}
