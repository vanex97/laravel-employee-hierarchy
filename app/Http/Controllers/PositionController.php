<?php

namespace App\Http\Controllers;

use App\DataTables\PositionDataTable;
use App\Http\Requests\Position\DestroyRequest;
use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PositionDataTable $dataTable)
    {
        return $dataTable->render('position.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Position::create($request->validated());
        return redirect(route('positions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('position.edit', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Position $position)
    {
        $position->update($request->validated());
        return redirect(route('positions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position, DestroyRequest $request)
    {
        // TODO: !!! FIX autocomplete!! ввод в поле и исключение удаляемой модели
        foreach ($position->employees as $employee) {
            $employee->position_id = $request->new_position_id;
            $employee->save();
        }
        $position->delete();
        return redirect(route('positions.index'));
    }

    /**
     * Data for select2 input.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $employees = Position::orderby('name', 'asc')
                ->select('id', 'name')
                ->get();
        } else {
            $employees = Position::orderby('name', 'asc')
                ->select('id', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }
        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->name
            );
        }
        return response()->json($response);
    }

}
