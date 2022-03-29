@extends('adminlte::page')

@section('title', 'Hierarchy')

@section('content_header')
    <h3>Hierarchy</h3>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="chart-container border" data="{{ route('hierarchy.data', $root) }}"></div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ mix('js/employeeTree.js') }}"></script>


@endsection
