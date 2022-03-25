<?php

namespace App\DataTables;

use App\Models\Position;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PositionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('updated_at', function ($position) {
                return date('d.m.y', strtotime($position->updated_at));
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d.%m.%y') like ?", ["%$keyword%"]);
            })
            ->addColumn('action', function ($position) {
                $editRoute = route('positions.edit', $position);
                return '<div class="text-nowrap">
                             <a class="btn btn-link" href="'.$editRoute.'" class="mr-4">
                                <i class="fas fa-pencil-alt"></i>
                             </a>' .
                    '<button class="btn btn-link"
                                     onclick="loadDeleteModal('.$position->id.',`'.$position->name.'`)"
                                     data-toggle="modal"
                                     data-target="#deleteModal">
                                <i class="fas fa-trash-alt"></i>
                            </>
                        </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Position $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Position $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('position-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc')
            ->lengthChange(true)
            ->addTableClass([' table-striped', 'compact'])
            ->lengthMenu()
            ->autoWidth(false)
            ->responsive(true);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('updated_at'),
            Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Position_' . date('YmdHis');
    }
}
