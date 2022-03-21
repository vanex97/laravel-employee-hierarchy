<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->except(['head', 'photo', 'phone_number']));
        $employee->phone_number = phone($request->phone_number, 'UA', 'international');
        $employee->photo = 'storage/'.$this->uploadEmployeePhoto($request);

        if($request->has('head')) {
            $employee->appendToNode(Employee::where('name', $request->head)->first());
        }

        $employee->save();

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function autocomplete(Request $request)
    {
        $name = $request->get('term');
        $filterResult = Employee::where('name', 'LIKE', '%'. $name. '%')
            ->select('name')
            ->limit(5)
            ->get();
        return response()->json($filterResult);
    }

    /**
     * @param Request $request
     * @return string Image path
     */
    private function uploadEmployeePhoto(Request $request)
    {
        $image = Image::make($request->file('photo'))
            ->fit(300, 300)
            ->orientate()
            ->stream('jpg', 80);

        $imagePath = 'employee_photos/'.uniqid().'.jpg';
        Storage::disk('public')->put($imagePath, $image);

        return $imagePath;
    }
}
