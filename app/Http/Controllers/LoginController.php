<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $hashar= app()->make('hash');

        $password= $request->input('password');
        $email= $request->input('email');

        $login = user::where('email',$email)->first();
        if($login){
            $res['success']=false;
            $res['message']="Su contraseña o email estan incorrectos";
            return response($res);
        }else{
            if($hashar->check($password,$login->password)){
                $api_token = sha1(time());
                $create_token = user::where('id', $login->id)->update(['api_token'=>$api_token]);
                if($create_token){
                    $res['success']=true;
                    $res['api_token']=$api_token;
                    $res['message']=$login;
                     return response($res);
                }
            }else{
                $res['success']=false;
                $res['message']="Su contraseña o email estan incorrectos";
                return response($res);
            }
        }
    }

    //
}