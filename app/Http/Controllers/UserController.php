<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
