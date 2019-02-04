<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $hasher= app()->make('hash');
        $username= $request->input('username');
        $email= $request->input('email');
        $password= $hasher->make($request->input('password'));

        $register = user::create([
            'username'=> $username,
            'email'=> $email,
            'password'=> $password,

        ]);
        if($register){
            $res['success']=true;
            $res['result']="Success Register";
            return response($res);
        }else{
            $res['success']=false;
            $res['result']="Failed to Register";
            return response($res);
        }
    }

    public function getUser(Request $request, $id){

        $user = user::where('id',$id)->get();
        if($user){
            $res['success']=true;
            $res['result']=$user;
            return response($res);
        }else{
            $res['success']=false;
            $res['result']="No se encontro user";
            return response($res);
        }
    }
}