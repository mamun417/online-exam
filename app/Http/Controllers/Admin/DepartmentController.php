<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Department;
use Illuminate\Http\Request;
use Str;


class DepartmentController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

        $departments = new Department();

        if ($keyword){
            $departments = $departments->where('name', 'like', '%'.$keyword.'%');
        }

        $departments = $departments->latest()->paginate($perPage);

        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
       return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments'
        ]);

        $request['code'] = Str::slug($request->name);

        Department::create($request->all());

        return redirect()->route('admin.departments.index')->with('successTMsg','Department save successfully');
    }

    public function edit(Department $department)
    {
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments,name,'.$department->id
        ]);

        $request['code'] = Str::slug($request->name);

        $department->update($request->all());

        return redirect(route('admin.departments.index'))->with('successTMsg', 'Department has been updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('successTMsg', 'Department has been deleted successfully');
    }
}
