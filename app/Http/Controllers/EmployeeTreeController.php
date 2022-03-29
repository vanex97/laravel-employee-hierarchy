<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeTreeCollection;
use App\Models\Employee;

class EmployeeTreeController extends Controller
{
    public function index()
    {
        $roots = Employee::whereIsRoot()->get();

        if($roots->count() === 1) {
            return view('employeeTree.show', ['root' => $roots->first()]);
        }
        return view('employeeTree.index', ['roots' => $roots]);
    }

    public function show(Employee $root)
    {
        return view('employeeTree.show', ['root' => $root]);
    }

    public function getData(Employee $root)
    {
        return new EmployeeTreeCollection(Employee::whereDescendantOrSelf($root)->get());
    }

}
