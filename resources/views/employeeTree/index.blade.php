@extends('adminlte::page')

@section('title', 'Hierarchy')

@section('content_header')
    <h3>Hierarchy roots</h3>
@endsection

@section('content')
    <div class="row">
        @foreach($roots as $root)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset($root->image->url) }}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $root->name }}</h3>
                    <p class="text-muted text-center">{{ $root->position->name }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                                <b>Oversees</b>
                                <a class="float-right">{{ \App\Models\Employee::whereDescendantOf($root)->count() }}</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary btn-sm mr-2" href="{{ route('hierarchy.show', $root) }}">
                            Show hierarchy
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ route('employees.show', $root) }}">
                            Show profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ mix('js/employeeTree.js') }}"></script>


@endsection
