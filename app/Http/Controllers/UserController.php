<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
  
    public function index()
    {
        
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit(User $user)
    {
        $user = User::where('id', 1)->where('role_id', 1)->first();
        
        return view('backend.admin.edit', compact('user'));
    }

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }


    public function changePassword(){
        return view('backend.partial.change_password');
    }


    public function updatePassword(Request $request){


        $validator = Validator::make($request->all(), [
            'password'     => 'required|min:8|confirmed',
            'old_password' => 'required|min:8'
        ])->validate();


        $find_user = User::find(Auth::user()->id);

       if(!Hash::check($request->old_password, $find_user->password)){

            return back()->with('olderror', 'Wrong old password');
       }

       $data = [];
       $data['password'] = Hash::make($request->password);

       User::where('id', Auth::user()->id)->update($data);

      return back()->with('successTMsg', 'Password Change Successfuly');

    }
}
