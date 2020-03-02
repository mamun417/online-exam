<?php

namespace App\Http\Controllers\Admin;

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
            $users = $users->where('name', 'like', $keyword)
                ->orWhere('last_name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword)
                ->orWhere('phone', 'like', $keyword);
        }

    	$users = $users->notAdmin()->latest()->paginate($perPage);

    	return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
    	return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
    	$request->validate([
            'expire_date' => 'required'
        ]);

    	$request['expire_date'] = date('Y-m-d', strtotime($request->expire_date));
    	$request['status'] = $request->status == 1 ?? 0;

        $user->update($request->all());

        return redirect(route('admin.users.index'))->with('successTMsg', 'User has been updated successfully');
    }
}
