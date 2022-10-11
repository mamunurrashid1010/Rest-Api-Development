<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userApiController extends Controller
{
    /**
     * getUser function
     * @param null $id
     * @return array with user information.
     */
    public function getUser($id=null){
        if($id==''){
            $users=User::get();
            return response()->json(['users'=>$users],200);
        }
        else{
            $users=User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }
}
