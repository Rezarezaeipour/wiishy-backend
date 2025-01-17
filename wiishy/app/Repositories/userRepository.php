<?php
namespace App\Repositories;

use App\Models\provider;
use App\Models\User;

class userRepository
{
    static function all($user_id){
        return User::where(['id'=>$user_id,'status'=>1])->first();
    }

    static function destroy($user_id){
        return User::where(['id'=>$user_id,'status'=>1])->update(['status'=>0]);
    }

    static function create($req){
        return User::create($req);
    }

    static function get($id){
        return User::where(['id'=>$id,'status'=>1])->first();
    }

    static function update($id,$request){
        User::where('id',$id)->update($request);
    }

    static function provider($provider){
        return provider::where('name',$provider)->first();
    }

    static function check($req , $provider_id){
        return User::where(['email'=>$req->email ,'provider_id'=>$provider_id ,'status'=>1])->first();
    }

    static function token($user){
        return $user->createToken('wiishy_token')->plainTextToken;
    }

    /* static function provider_id_return($id){
        return User::where('id',$id)->first()->provider_id;
    } */
}