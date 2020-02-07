<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BackendUserController extends Controller
{
    public function index()
    {

    	$users = new User();
    	$users = $users->latest()->paginate(1);

    	return view('backend.user.index', compact('users'));
    }


    public function expireDateEdit($id)
    {
    	$user = User::find($id);
    	return view('backend.user.edit', compact('user'));
    }


    public function expireDateUpdate(Request $request, $id)
    {
    	$request->validate([
            'expire_date' => 'required'
        ]);

		$user = User::find($id);
        $user->update($request->all());

        return redirect(route('users.index'))->with('successTMsg', 'User expire date has been updated successfully');

    }
}
