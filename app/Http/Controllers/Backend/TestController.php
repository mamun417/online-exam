<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        return view('backend.test.test');
    }
    public function testfunction(Request $request){

        $name = $request->testname;
        if ($name =='laravel') {
          return back()->with('success','Successfully get laravel data!');

        }else {
          return back()->with('error','error sdgshdfh');

        }


    }


}
