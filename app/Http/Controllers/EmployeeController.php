<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\DataTables\SubordinatesDataTable;
use App\Http\Requests\Employee\ReEmploymentRequest;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee;
use App\Models\Image;
use App\Models\Position;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

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
    public function store(StoreRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->except(['head', 'photo', 'phone_number']));
        $employee->phone_number = phone($request->phone_number, 'UA', 'international');

        if($request->head) {
            $employee->appendToNode(Employee::where('name', $request->head)->first());
        }

        $uploadedPhoto = Cloudinary::upload(
            Image::formatForEmployeePhoto($request->file('photo'))
        );
        $employee->image()->associate(Image::create([
            'public_id' => $uploadedPhoto->getPublicId(),
            'url' => $uploadedPhoto->getSecurePath()
        ]));

        $employee->save();

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, SubordinatesDataTable $dataTable)
    {
        $dataTable->setHead($employee);
        return $dataTable->render('employee.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', [
            'employee' => $employee,
            'employeePositionName' => Position::find($employee->position_id)->name,
            'employeeHeadName' => $employee->head_id ? Employee::find($employee->head_id)->name : null
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Employee $employee)
    {
        $employee->fill($request->except(['head', 'photo', 'phone_number']));
        $employee->phone_number = phone($request->phone_number, 'UA', 'international');

        // Update head
        if($request->head) {
            $employee->appendToNode(Employee::where('name', $request->head)->first());
        } else {
            $employee->makeRoot();
        }

        // Update photo
        if ($request->hasFile('photo')) {
            Cloudinary::destroy($employee->image->public_id);

            $uploadedPhoto = Cloudinary::upload(
                Image::formatForEmployeePhoto($request->file('photo'))
            );
            $employee->image->update([
                'public_id' => $uploadedPhoto->getPublicId(),
                'url' => $uploadedPhoto->getSecurePath()
            ]);
        }

        $employee->save();

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->children->isEmpty()) {
            Cloudinary::destroy($employee->image->public_id);
            $employee->delete();
            return redirect(route('employees.index'));
        }

        return redirect(route('employees.reEmployment', $employee));
    }

    public function reEmployment(Employee $head)
    {
        $subordinates = $head->children;

        return view('employee.re-employment', [
            'employees' => $subordinates,
            'head' => $head
        ]);
    }

    public function destroyAndReEmployment(ReEmploymentRequest $request, Employee $head)
    {
        $reEmployments = $request->reEmployments;

        foreach($reEmployments as $reEmployment) {
            $employee = Employee::find($reEmployment['subordinate_id']);

            if ($reEmployment['head'] === null) {
                Cloudinary::destroy($employee->image->public_id);
                continue;
            }
            $employee->appendToNode(Employee::where('name', $reEmployment['head'])->first())
                ->save();
        }
        Cloudinary::destroy($head->image->public_id);
        $head->delete();

        return redirect(route('employees.index'));
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
}
