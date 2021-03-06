<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\AccountResource;

class UserResourceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('role') == 'admin' || $request->input('role') == 'hr'){
            return UserResource::collection(User::all())->response("Success", 200);
        }else{
            return response("Forbidden", 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = User::where('email', $request->input('email'))->count();
        if($count == 0){
            $user = new User;
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->api_token = hash('sha256',$request->input('email'));

            if($user->save()){
                return (new UserResource($user))->response("Success", 201);
            }
        }else{
            return response("Account already exists", 409);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(User::find($id) != null){
            return (new UserResource(User::find($id)))->response("Success", 200);
        }else{
            return response("Not found", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->input('role') == 'admin'){
            $user = User::find($request->input('id'));
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->address = $request->input('address');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->api_token = hash('sha256',$request->input('email'));

            if($user->save()){
                return (new UserResource($user))->response("Success", 200);
            }
        }
        else{
            return response("Forbidden", 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->input('role') == 'admin'){
            $user = User::find($request->input('id'));
            
            if($user->delete()){
                return response("Deleted", 204);
            }
        }else{
            return response("Forbidden", 403);
        }
    }

    /**
     * get the user account
     * @param  \Illuminate\Http\Request
      * @return \Illuminate\Http\Response
     */
    public function account(Request $request)
    {
        if(User::find($request->input('user_id')) != null){
            $user = User::find($request->input('user_id'));
            if($user != null){
                return (new AccountResource($user->account))->response("Success", 200);
            }else{
                return response(['message' => 'User not found'], 404);
            }
            
        }else{
            return response("Not found", 404);
        }
    }

}
