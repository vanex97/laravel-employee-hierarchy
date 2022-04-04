@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employee create</h1>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-6">
        <div class="card card-primary">
            <h3 class="mt-3 ml-4 mb-0">Add employee</h3>
            <form id="employee_form"
                  action="{{ route('employees.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="mb-0">Photo</label>
                        @error('photo')
                        <div class="invalid-feedback d-block mb-1">{{ $message }}</div>
                        @enderror
                        <input type="file"
                               name="photo"
                               class="form-control-file"
                               accept="image/jpeg,image/png"
                               required>
                        <small class="form-text text-muted">
                            File format jpg,png up to 5MB, the minimum size of 300x300px
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               name="name"
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               value="{{ old('phone_number') }}"
                               name="phone_number"
                               required>
                        @error('phone_number')
                        <div class="invalid-feedback d-inline">{{ $message }}</div>
                        @enderror
                        @if (count($supportedPhoneCountries) === 1)
                            <small class="form-text text-muted float-right">
                                Supported country: {{ implode(', ', $supportedPhoneCountries) }}
                            </small>
                        @elseif (count($supportedPhoneCountries) > 1)
                            <small class="form-text text-muted float-right">
                                Supported countries: {{ implode(', ', $supportedPhoneCountries) }}
                            </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               name="email"
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <select id="position-select"
                                class="form-control @error('position_id') is-invalid @enderror"
                                name="position_id"
                                url="{{ route('positions.autocomplete') }}"
                                required>
                            @if(old('position_id'))
                                <option value="{{ old('position_id') }}">
                                    {{ \App\Models\Position::find(old('position_id'))->name }}
                                </option>
                            @endif
                        </select>
                        @error('position')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Salary, $</label>
                        <input type="text"
                               class="form-control @error('salary') is-invalid @enderror"
                               value="{{ number_format(old('salary')) || null }}"
                               name="salary"
                               required>
                        @error('salary')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Head</label>
                        <input id="head-input"
                               type="text"
                               class="form-control @error('head') is-invalid @enderror"
                               value="{{ old('head') }}"
                               name="head"
                               url="{{ route('employees.autocomplete') }}">
                        @error('head')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Date of employment</label>
                        <input type="text"
                               class="form-control datetimepicker-input @error('employment_date') is-invalid @enderror"
                               value="{{ old('employment_date') }}"
                               name="employment_date"
                               id="employment_date"
                               data-toggle="datetimepicker"
                               data-target="#employment_date">
                        @error('employment_date')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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
    <script src="{{ mix('js/employeeForm.js') }}"></script>
@endsection
