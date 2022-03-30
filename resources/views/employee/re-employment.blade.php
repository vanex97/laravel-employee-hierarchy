@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h4 class="pt-2 pl-2">Re-employee</h4>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="border">
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
                            <form id="reEmployeeForm" method="POST"
                                  action="{{ route('employees.reEmploymentStore', $head) }}">
                                @csrf
                                @method('DELETE')
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr class="odd">
                                        <td><img class="img-circle img-size-32"
                                                 src="{{ asset($employee->photo) }}" alt="photo">
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                        <td>{{ $employee->employment_date }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ number_format($employee->salary) }}</td>
                                        <td>
                                            <input name="reEmployments[{{ $loop->index }}][subordinate_id]"
                                                   value="{{ $employee->id }}"
                                                   form="reEmployeeForm"
                                                   hidden>
                                            <input type="text"
                                                   class="form-control head-input @error("reEmployments.$loop->index.head") is-invalid @enderror"
                                                   name="reEmployments[{{ $loop->index }}][head]"
                                                   form="reEmployeeForm"
                                                   style="min-width: 150px"
                                                   employee="{{ $employee->name }}"
                                                   url="{{ route('employees.autocomplete') }}">
                                            @error("reEmployments.$loop->index.head")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                            </tbody>
                        </table>
                        <div class="row d-flex justify-content-between align-items-center">
                            <p class="text-danger text-right ml-2">
                                Warning! Employees without a new head will be removed.
                            </p>
                            <div class="row mr-2">
                                <a class="btn btn-default mr-2" href="{{ route('employees.index') }}">Cancel</a>
                                <button class="btn btn-primary"
                                        id="confirm-button"
                                        data-toggle="modal"
                                        data-target="#deleteModal">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove the head <strong>{{ $head->name }}</strong>?
                        <div id="delete-alert">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                form="reEmployeeForm"
                                class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
