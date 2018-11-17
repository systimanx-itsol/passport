<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Auth;

class APILoginController extends Controller
{
    public function register(){
        $inputs = file_get_contents("php://input");
        $data = json_decode($inputs);
        $name = $data->name;
        $email = $data->email;
        $check_user_count = User::where('email', $email)->count();
        if($check_user_count == 0){
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'user_role' => 'U',
                'password' => bcrypt($data->password)
            ]);
            $token =  $user->createToken('MyApp')->accessToken;
            $results = array(
                'token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            );
            $status = 1;
        }
        else{
            $status = 0;
            $message = "User already Exists.";
        }
        if($status == 1){
            return response::json(array('status' => 1, 'message' => 'success', 'result' => $results))
                    ->header('token', $token);
        }
        else{
            return response::json(array('status' => $status, 'message' => $message));
        }
    }


    public function login(){
        $inputs = file_get_contents("php://input");
        $data = json_decode($inputs);
        $email = $data->email;
        $password = $data->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            $results = array(
                'name' => $user->name,
                'email' => $user->email,
            );
            return response::json(array('status' => 1, 'message' => 'success', 'result' => $results), 200)
                        ->header('jwt_token', $token);
        }
        else{
            return response::json(array('status' => 0, 'message' => 'invalid email or password'));
        }
    }
}
