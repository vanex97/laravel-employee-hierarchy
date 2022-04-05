@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Positions</h1>
        <a class="btn btn-primary" href="{{ route('positions.create') }}">Add position</a>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove position <span id="position-name-modal"></span>?
                        <form id="delete-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group mt-2">
                                    <label>New position for employees</label>
                                    <select id="position-select"
                                            class="form-control @error('position_id') is-invalid @enderror"
                                            name="new_position_id"
                                            url="{{ route('positions.autocomplete') }}"
                                            required>
                                        @if(old('position_id'))
                                            <option value="{{ old('position_id') }}">
                                                {{ \App\Models\Position::find(old('position_id'))->name }}
                                            </option>
                                        @endif
                                    </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Remove</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="border">
        <h4 class="pt-2 pl-2">Position list</h4>
        {{$dataTable->table()}}
    </div>

    <style>
        #position-table_wrapper .row:first-child  {
            padding: 0.5rem 0.5rem 0 0.5rem;
        }
        #position-table_wrapper .row:last-child  {
            padding: 0 0.5rem 0.5rem 0.5rem;
        }
    </style>

@endsection

@section('js')
    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ mix('js/employeeForm.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
    <script>
        function loadDeleteModal(id, name) {
            $('#position-name-modal').html(name);

            let actionUrl = '{{ route('positions.destroy', ':id') }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#delete-form').attr('action', actionUrl);
        }

    </script>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@endsection
