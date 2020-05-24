<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Package;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	$perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

    	$users = User::with('department', 'package');

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
        $packages = Package::latest()->get();
    	return view('admin.user.edit', compact('user', 'packages'));
    }

    public function update(Request $request, User $user)
    {
    	$request->validate([
            'expire_date' => 'required'
        ]);

    	$request['expire_date'] = date('Y-m-d', strtotime($request->expire_date));
    	$request['is_paid'] = $request->is_paid == 1 ?? 0;
    	$request['status'] = $request->status == 1 ?? 0;

        $user->update($request->all());

        return redirect(route('admin.users.index'))->with('successTMsg', 'User has been updated successfully');
    }
}
