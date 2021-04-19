<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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
            ->addColumn('Action', 'pages.category.actions')
            ->editColumn('active', fn ($v) => $v ? 'Active' : 'In-Active')
            ->rawColumns(['Action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        // with trashed search
        if ($this->request->get('trashed') == 'with') {
            return $model->withTrashed();
        }

        // with trashed search
        if ($this->request->get('trashed') == 'only') {
            return $model->onlyTrashed();
        }

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
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->ajax([
                'data' => "function (d) {
                    d.trashed = $('select[name=trashed]').val();
                }"
            ])
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons(
                Button::raw([
                    'text' => 'Create',
                    'action' => 'function(){location.href="' . route('category.create') . '"}'
                ]),
                Button::make('pageLength'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('active'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('Action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Categories_' . date('YmdHis');
    }
}
