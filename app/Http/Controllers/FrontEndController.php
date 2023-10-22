<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{


    public function EntitiesForm(){

        return view('frontend.entities.form');
    }
}
