<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	$perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

    	$users = new User();

    	if ($keyword){
    		$keyword = '%'.$keyword.'%';
            $users = $users->where('name', 'like', $keyword)->orWhere('last_name', 'like', $keyword)->orWhere('email', 'like', $keyword);
        }

    	$users = $users->latest()->paginate($perPage);

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
