@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employees</h1>
@endsection

@section('content')
    <div class="border overflow-auto">
        <h4 class="pt-2 pl-2">Employee list</h4>
        {{$dataTable->table()}}
    </div>

    <style>
        #employee-table_wrapper .row:first-child  {
            padding: 0.5rem 0.5rem 0 0.5rem;
        }
        #employee-table_wrapper .row:last-child  {
            padding: 0 0.5rem 0.5rem 0.5rem;
        }
    </style>

@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection
