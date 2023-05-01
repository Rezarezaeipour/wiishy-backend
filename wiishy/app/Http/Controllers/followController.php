<?php

namespace App\Http\Controllers;

use App\Repositories\followRepository;
use Illuminate\Http\Request;


class followController extends Controller
{
//_____________________ All the followers of a user 
    function user_followers($user_id){
        try{
            $followers_count=followRepository::count($user_id,'followers');
        }
        catch(\Exception $exception){
            return response(['message'=>'user not found'] , 400);
        }
        $followers=followRepository::list($user_id,'userfollows.user_id','userfollows.follow_id');
        return response(['followers_count'=>$followers_count , 'followers'=>$followers]);
    }  
    
//_____________________ All the following of a user 
    function user_followings($user_id){
        try{
            $followings_count=followRepository::count($user_id,'followings');
        }
        catch(\Exception $exception){
                return response(['message'=>'user not found'] , 400);
        }
        $followings=followRepository::list($user_id,'userfollows.follow_id','userfollows.user_id');  
        return response(['followings_count'=>$followings_count , 'followings'=>$followings]);
    }

//_____________________ IS Follow?
    function isfollow($user_id,$follow_id){
        $follow=followRepository::check($user_id,$follow_id);
        if($follow)
            return response(['message'=>'yes']);
        return response(['message'=>'no']);
    }


//_____________________ Follow
    function follow($user_id,$follow_id){
        $follow=followRepository::check($user_id,$follow_id);
        if($follow)
            return response(['message'=>'user has been already followed'],400);

        followRepository::follow($user_id,$follow_id);

        followRepository::increase($user_id,'followings');
        followRepository::increase($follow_id,'followers');
        return response(['message'=>'The follow process has done successfully']);
    }

//_____________________ UnFollow
    function unfollow($user_id,$follow_id){
        $follow=followRepository::check($user_id,$follow_id);
        if(!$follow)
            return response(['message'=>'user hasnt been followed'],400);

        followRepository::unfollow($user_id,$follow_id);

        followRepository::decrease($user_id,'followings');
        followRepository::decrease($follow_id,'followers');    
        return response(['message'=>'The Unfollow process has done successfully']);
    }
}
