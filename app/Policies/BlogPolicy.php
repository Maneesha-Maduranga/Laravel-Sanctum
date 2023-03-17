<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
   


  
    public function update(User $user, Blog $blog)
    {
        if($user->id === $blog->user_id){
            return true;
        }
        else{
            $respoce = [
                "sucess"=>false,
                "message"=>"Not authorized Perform task",
            ]; 
            return $respoce;
        }
    }

    
    public function delete(User $user, Blog $blog):Response
    {
        return $user->id === $blog->user_id
        ? Response::allow()
        : Response::denyWithStatus(404);
        
        
    }
}
