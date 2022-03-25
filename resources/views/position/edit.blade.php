@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <h1>Position</h1>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-6">
        <div class="card card-primary">
            <h3 class="mt-3 ml-4 mb-0">Position edit</h3>
            <form id="position_form"
                  action="{{ route('positions.update', $position) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $position->name) }}"
                               name="name"
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p><strong>Created at: </strong>{{ date_format($position->created_at, 'd.m.y') }}</p>
                            <p><strong>Updated at: </strong>{{ date_format($position->updated_at, 'd.m.y') }}</p>
                        </div>
                        <div class="pr-5">
                            <p><strong>Admin created id: </strong>{{ $position->admin_created_id }}</p>
                            <p><strong>Admin updated id: </strong>{{ $position->admin_updated_id }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right ml-3">Save</button>
                    <button class="btn btn-default float-right">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
@endsection
