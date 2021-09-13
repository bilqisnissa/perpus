<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function createUser(Request $request){
        $data = $request->all();
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        //masukkin data phone
        $user->phone()->create([
            'phone' => $data['phone']
        ]);
        $user->phone;

        $status = "success";
        return response()->json(compact('user', 'status'), 200);
    }

    public function getUser($id){
        $user = User::find($id);
        $user->phone();
        $status = "success";
        return response()->json(compact('user', 'status'), 200);
    }

    public function updateUser($id, Request $request){
        $data = $request->all();
        $user = User::find($id);
        
        $validator = Validator::make(
            $data, [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users, email', $id,
                'password' => 'required|string|min:6',
            ]
            );

            if($validator->fails()){
                $error = $validator->errors();
                return response()->json(compact('error'), 401);
            }

        $data = $request->all;
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        $user->phone()->phone = $data['phone'];
        $user->push();

        $status = "success";
        return response()->json(compact('user', 'status'),200);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->phone->delete();
        $user->delete();
        $status = "delete success";
        return response()->json(compact('satus'),200);
    }

}
