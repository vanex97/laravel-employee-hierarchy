<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($employee) {
                $editRoute = route('employees.edit', $employee);
                $showRoute = route('employees.show', $employee);
                return '<div class="text-nowrap">
                            <a class="btn btn-link" href="'.$showRoute.'" class="mr-2">
                                <i class="far fa-eye"></i>
                            </a>
                             <a class="btn btn-link" href="'.$editRoute.'" class="mr-2">
                                <i class="fas fa-pencil-alt"></i>
                             </a>' .
                            '<button class="btn btn-link"
                                     onclick="loadDeleteModal('.$employee->id.',`'.$employee->name.'`)"
                                     data-toggle="modal"
                                     data-target="#deleteModal">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>';
            })
            ->editColumn('employment_date', function ($employee) {
                return date('d.m.y', strtotime($employee->employment_date));
            })
            ->filterColumn('employment_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(employment_date,'%d.%m.%y') like ?", ["%$keyword%"]);
            })
            ->editColumn('salary', function ($employee) {
                return '$' . number_format($employee->salary);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Employee $model
     * @return Builder
     */
    public function query(Employee $model): Builder
    {
        return $model::join(
                'positions', 'employees.position_id', '=', 'positions.id',
            )
            ->join(
                'images', 'employees.image_id', '=', 'images.id'
            )
            ->select([
                'employees.id',
                'images.url as photo',
                'employees.name',
                'positions.name as position_name',
                'employees.employment_date',
                'employees.phone_number',
                'employees.email',
                'employees.salary'
            ])
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
                    ->setTableId('employee-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1, 'asc')
                    ->lengthChange(true)
                    ->addTableClass([' table-striped', 'compact']) //compact nowrap w-100
                    ->lengthMenu()
                    ->autoWidth(false)
                    ->responsive(true)
                    ->ajax(route('employees.index'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('photo', 'Photo')
                ->searchable(false)
                ->orderable(false)
                ->render('function() {
                    return `<img class="img-circle img-size-32" src="${data}" alt="photo">`
                }'),
          Column::make('name', 'employees.name'),
            Column::make('position_name', 'positions.name')
                ->title('Position')
                ->searchable(true),
            Column::make('employment_date')
                ->title('Date of employment'),
            Column::make('phone_number'),
            Column::make('email'),
            Column::make('salary'),
            Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Employee_' . date('YmdHis');
    }


}
