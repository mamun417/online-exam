<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function getProfile(){
        $user = User::find(Auth::user()->id);
        return view('backend.partial.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user){
        $request->validate([
            'name'      => 'required|max:200|string',
            'last_name' => 'required|max:200|string',
            'email'     => 'required'
        ]);

        $user->update($request->all());
        return redirect(route('show.profile'))->with('successTMsg', 'Examination has been updated successfully');
    }

    public function changePassword(){
        return view('backend.partial.change_password');
    }

    public function updatePassword(Request $request){

        Validator::make($request->all(), [
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

       return back()->with('successTMsg', 'Password Change Successfully');
    }
}
