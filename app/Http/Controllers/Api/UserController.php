<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;


class UserController extends Controller
{
    public function login(Request $request){


        try{
            $utilisateur = User::where(array('password'=>$request->password,'email'=>$request->email))->first();
            if(isset($utilisateur)){

                  return(['message'=>'succefully','user'=>$utilisateur]);


           }
           else{

               return(['message'=>'unsuccefully','user'=>null]);

           }

           }catch (\Exception $th) {
             return 'unsuccefully';

            }
    }



    public function register(Request $request){


        // error_log($request);
        $email = $request->email;
        $result = DB::table('users')
                    ->where('email',$email)
                    ->first();
        if(isset($result)){

            return(['message'=>'already','user'=>null]);
        }
        else {
            try {
                $user = new User();

                $user->prenom = $request->prenom;
                $user->nom = $request->nom;
                $user->adresse = $request->adresse;
                $user->telephone = $request->telephone;
                $user->email = $request->email;
                $user->password = $request->password;

                $user->save();
                return(['message'=>'succefully','user'=>$user]);
            } catch (\Exception $th) {

                return(['message'=>'unsuccefully','user'=>null]);

            }
        }

    }

}
