<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Study;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{


    public function entitiesForm(){

        return view('frontend.entities.form', ['action' => 'create']);
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'parameters' => [
                'file' => data_get($data, 'file'),
                'cae' => (int)data_get($data, 'cae'),
            ],
            'data' => [
                'role' => data_get($data, 'role')
            ]

        ]);
        Auth::login($user);
        return redirect()->route('homepage');
    }

    public function showStudy($id){
        $study = Study::find($id);
        $allExams = Exam::whereIn('id', data_get($study, 'data.pending'))->get();
        return view('frontend.entities.study', ['study' => $study, 'allExams' => $allExams, 'action' => 'show']);
    }

    public function editStudy($id){
        $study = Study::find($id);
        $allExams = Exam::whereIn('id', data_get($study, 'data.pending'))->get();
        return view('frontend.entities.study', ['study' => $study, 'allExams' => $allExams, 'action' => 'edit']);
    }

}
