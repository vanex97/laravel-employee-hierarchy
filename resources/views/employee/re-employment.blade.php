@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="border overflow-auto">
            <h4 class="pt-2 pl-2">Employee list</h4>
            <div id="employee-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped compact dataTable no-footer" id="employee-table"
                               aria-describedby="employee-table_info">
                            <thead>
                            <tr>
                                <th title="Photo" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Photo">
                                    Photo
                                </th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Date of employment</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Salary</th>
                                <th>New Head</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form id="reEmployeeForm" method="POST"
                                  action="{{ route('employees.reEmploymentStore', $head) }}">
                                @csrf
                                @method('DELETE')
                                @foreach($employees as $employee)
                                    <tr class="odd">
                                        <td><img class="img-circle img-size-32"
                                                 src="{{ asset($employee->photo) }}" alt="photo">
                                        </td>
                                        <td class="sorting_1">{{ $employee->name }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                        <td>{{ $employee->employment_date }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ number_format($employee->salary) }}</td>
                                        <td>
                                            <input name="reEmployments[{{ $loop->index }}][subordinate_id]"
                                                   value="{{ $employee->id }}"
                                                   hidden>
                                            <input type="text"
                                                   class="form-control head-input @error("reEmployments.$loop->index.head_name") is-invalid @enderror"
                                                   name="reEmployments[{{ $loop->index }}][head]"
                                                   url="{{ route('employees.autocomplete') }}">
                                            @error("reEmployments.$loop->index.head_name")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row float-right mr-2">
                    <a class="btn btn-default mr-2" href="{{ route('employees.index') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit" form="reEmployeeForm">Save</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ mix('js/reEmploymentForm.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection
