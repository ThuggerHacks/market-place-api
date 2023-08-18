<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserValidator;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index(){
        return User::get();
    }

    public function getOne($id = 0){
        return User::where(["id" => $id])->first();
    }

    public function signUp(UserValidator $request){
    
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $profile = $request->profile;
        $location = $request->location;
        $phone = $request->phone;

        $findUser = User::where(["email" => $email])->first();

        if($findUser){
            return response()->json(["error" => "Utilizador ja existe"]);
        }

        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => md5($password),
            "profile" => $profile,
            "location" => $location,
            "phone" => $phone
        ]);

        return $user;
    }

    public function login(Request $request){

        $email = $request->email;
        $pass = $request->password;

        $user = User::where("email",$email)->where("password",md5($pass))->first();

        if(!$user){
            return response()->json(["error" => "Dados invalidos!"]);
        }

        return response()->json($user);
    }

    public function deleteOne($id = 0) {
        $user = User::where("id",$id)->first();

        if(!$user){
            return response()->json(["error" => "Utilizador nao existe!"]);
        }

        $user = $user->delete();
        
        return $user;
    }

    public function updateOne(Request $request, $id = 0) {

        $user = User::find($id);

        $name = trim($request->name) == ""?$user->name:$request->name;
        $email = trim($request->email) == ""?$user->email:$request->email;
        $password = $request->password;
        $profile = trim($request->profile) == ""?$user->profile:$request->profile;
        $location = trim($request->location) == ""?$user->location:$request->location;
        $phone = trim($request->phone) == ""? $user->phone:$request->phone;


        if(!$user){
            return response()->json(["error" => "Utilizador nao existe!"]);
        }

        $user->update([
            "name" => $name,
            "email" => $email,
            "password" => trim($password) == ""? md5($password):$user->password,
            "profile" => $profile,
            "location" => $location,
            "phone" => $phone
        ]);

        return $user;
    }
   
}
