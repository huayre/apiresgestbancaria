<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function Register(Request $request)
    {
      $user=User::create(
          [
              'name'        =>$request->name,
              'email'       =>$request->email,
              'password'    =>Hash::make($request->password)
          ]);
          $token = $user->createToken('Token Name')->accessToken;
          return response()->json(['token'=>$token,'mensage'=>'el Ussuario fue registrado correctamente']);
    }

    public function Login(Request $request)
    {

       $user=User::where('email',$request->email)->first();
      if(isset($user) && Hash::check($request->password,$user->password))
       {
          $token=$user->createToken('Token Name')->accessToken;
          return response()->json(['token'=>$token]);
       }
      else{
          return response()->json(['mensaje'=>'credenciales incorrectas']);
      }


    }

}
