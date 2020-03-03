<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Validator;

class UserController extends Controller
{
    public function profile(){
        $user = User::find(Auth::user()->id);
        return view('admin.partial.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user){
        $request->validate([
            'name'      => 'required|max:200|string',
            'last_name' => 'required|max:200|string',
            //'email'     => 'required'
        ]);

        $user->update($request->except('email'));
        return redirect(route('profile'))->with('successTMsg', 'Profile has been updated successfully');
    }

    public function changePassword(){
        return view('admin.partial.change_password');
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

    public function renew()
    {
        Session::put('renew', true);
        return view('exampleHosted');
    }
}
