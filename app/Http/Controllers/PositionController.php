<?php

namespace App\Http\Controllers;

use App\DataTables\PositionDataTable;
use App\Http\Requests\PositionRequest;
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
    public function store(PositionRequest $request)
    {
        Position::create($request->validated());
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
