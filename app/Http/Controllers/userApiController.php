<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

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

    /**
     * addUser function, add new single user record
     * @param $request->name, $request->email, $request->password
     * @return Json with success/fail message
     */
    public function addUser(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            // validation
            $rule=[
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required',
            ];
            $customMessage=[
                'name.required'     => 'Name is required',
                'email.required'    => 'Email is required',
                'email.email'       => 'Email must be a valid mail',
                'password.required' => 'Password is required',
            ];
            $validation=Validator::make($data,$rule,$customMessage);
            if($validation->fails()){
                return response()->json($validation->errors(),422);
            }

            // create
            $user= new User();
            $user->name     =  $data['name'];
            $user->email    =  $data['email'];
            $user->password =  Hash::make($data['password']);
            $user->save();
            $message="User Create Successfully";
            return response()->json(['message'=>$message],201);
        }
    }

    /**
     * addMultipleUsers function, add multiple user record
     */
    public function addMultipleUsers(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            // validation
            $rule=[
                'users.*.name'      => 'required',
                'users.*.email'     => 'required|email|unique:users',
                'users.*.password'  => 'required',
            ];
            $customMessage=[
                'users.*.name.required'     => 'Name is required',
                'users.*.email.required'    => 'Email is required',
                'users.*.email.email'       => 'Email must be a valid mail',
                'users.*.password.required' => 'Password is required',
            ];
            $validation=Validator::make($data,$rule,$customMessage);
            if($validation->fails()){
                return response()->json($validation->errors(),422);
            }

            // create
            foreach($data['users'] as $userInfo){
                $user= new User();
                $user->name     =  $userInfo['name'];
                $user->email    =  $userInfo['email'];
                $user->password =  Hash::make($userInfo['password']);
                $user->save();
            }

            $message="User Create Successfully";
            return response()->json(['message'=>$message],201);
        }
    }

    /**
     * updateUserDetails function, update user record
     * @param $request->id, $request->name, $request->password
     * @return Json with success/fail message
     */
    public function updateUserDetails(Request $request){
        if($request->isMethod('put')){
            $data=$request->all();

            // validation
            $rule=[
                'name'      => 'required',
                'password'  => 'required',
            ];
            $customMessage=[
                'name.required'     => 'Name is required',
                'password.required' => 'Password is required',
            ];
            $validation=Validator::make($data,$rule,$customMessage);
            if($validation->fails()){
                return response()->json($validation->errors(),422);
            }

            // update user record
            $user= User::findOrFail($request->id);
            $user->name     =  $data['name'];
            $user->password =  Hash::make($data['password']);
            $user->save();
            $message="User Update Successfully";
            return response()->json(['message'=>$message],202);
        }
    }
}
