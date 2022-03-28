@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
    <h1></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset($employee->photo) }}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $employee->name }}</h3>
                    <p class="text-muted text-center">{{ $employee->position->name }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Date of employment</b>
                            <a class="float-right">{{ date('d.m.y', strtotime($employee->employment_date))}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b>
                            <a href="tel:{{ $employee->phone_number }}"
                               class="float-right">{{ $employee->phone_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b>
                            <a href="mailto:{{ $employee->email }}" class="float-right">{{ $employee->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Salary</b> <a class="float-right">{{ number_format($employee->salary) }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#subordinates" data-toggle="tab">
                                Subordinates
                            </a>
                        </li>
{{--                        <li class="nav-item"><a class="nav-link" href="#tasks" data-toggle="tab">Tasks</a></li>--}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="subordinates">
                            @if(\App\Models\Employee::where('head_id', $employee->id)->exists())
                                {{$dataTable->table()}}
                            @else
                                <p>This user has no subordinate</p>
                            @endif
                        </div>
{{--                        <div class="tab-pane" id="+++"></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{ $dataTable->scripts() }}
@endsection
