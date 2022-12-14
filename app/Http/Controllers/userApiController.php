<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * deleteUser function
     * delete single user details from db table
     * @param $request->id ;user id
     * @return Json response with message.
     */
    public function deleteUser(Request $request){
        $result=User::findOrFail($request->id)->delete();
        if($result){
            $message="User Delete Successfully";
            return response()->json(['message'=>$message],200);
        }
        else{
            $message="Fail";
            return response()->json(['message'=>$message],422);
        }
    }

    /**
     * deleteMultipleUser
     * @param $request->ids ;user id
     * @return Json response with message.
     */
    public function deleteMultipleUser(Request $request){
            if($request->isMethod('delete')){
                $data=$request->all();
                User::whereIn('id',$data['ids'])->delete();
                $message="User Delete Successfully";
                return response()->json(['message'=>$message],200);
            }
    }

    /**
     * userRegistrationUsingPassport function
     * @param $request->name, $request->email, $request->password
     * @return Json with message(success/fail) and access_token
     */
    public function userRegistrationUsingPassport(Request $request){
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

            // create new user
            $user= new User();
            $user->name     =  $data['name'];
            $user->email    =  $data['email'];
            $user->password =  Hash::make($data['password']);
            $user->save();

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $userDetails= User::where('email',$data['email'])->first();
                $access_token=$user->createToken($data['email'])->accessToken;
                User::where('email',$userDetails->email)->update(['access_token'=>$access_token]);
                $message="User Successfully Registered";
                return response()->json(['message'=>$message,'access_token'=>$access_token],201);
            }
            else{
                $message="Fail!";
                return response()->json(['message'=>$message],422);
            }
        }
    }

    /**
     * userLoginUsingPassport function
     * @param $request->email, $request->password
     * @return Json with [message, access_token]
     */
    public function userLoginUsingPassport(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            // validation
            $rule=[
                'email'     => 'required|email|exists:users',
                'password'  => 'required',
            ];
            $customMessage=[
                'email.required'    => 'Email is required',
                'email.email'       => 'Email must be a valid mail',
                'email.exists'      => 'Email does not exist',
                'password.required' => 'Password is required',
            ];
            $validation=Validator::make($data,$rule,$customMessage);
            if($validation->fails()){
                return response()->json($validation->errors(),422);
            }

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $user=new User();
                $userDetails= User::where('email',$data['email'])->first();
                $access_token=$user->createToken($data['email'])->accessToken;
                User::where('email',$userDetails->email)->update(['access_token'=>$access_token]);
                $message="User Successfully Login";
                return response()->json(['message'=>$message,'access_token'=>$access_token],200);
            }
            else{
                $message="User login Fail!";
                return response()->json(['message'=>$message],422);
            }
        }
    }
}
