<?php

namespace App\Http\Controllers;

use App\DataTables\PositionDataTable;
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
