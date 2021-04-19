<?php

namespace App\DataTables;

use App\Models\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
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
            ->addColumn('Action', 'pages.course.actions')
            ->editColumn('active', fn ($v) => $v ? 'Active' : 'In-Active')
            ->addColumn('category', function (Course $course) {
                return optional($course->category)->name ?: '--';
            })
            ->rawColumns(['Action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Course $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
    {
        $courses =  $model->select('courses.*', 'categories.name')
            ->leftJoin('categories', 'categories.id', '=', 'courses.category_id');

        // where rating search
        if ($this->request->get('rating')) {
            $courses->where('rating', $this->request->get('rating'));
        }

        // where category_id search
        if ($this->request->get('category_id')) {
            $courses->where('category_id', $this->request->get('category_id'));
        }

        // where levels search
        if ($this->request->get('levels')) {
            $courses->whereIn('level', $this->request->get('levels'));
        }

        // where hours search
        if ($hours = $this->request->get('hours')) {
            $courses->where(function ($q)  use ($hours) {
                foreach (array_unique($hours) as $index => $hour) {
                    switch ($hour) {
                        case 'less-4':
                            if ($index) {
                                $q->orWhere('hours', '<=', 4);
                            } else {
                                $q->where('hours', '<=', 4);
                            }
                            break;
                        case 'less-8':
                            if ($index) {
                                $q->orWhere('hours', '<=', 8);
                            } else {
                                $q->where('hours', '<=', 8);
                            }
                            break;
                        case 'more-8':
                            if ($index) {
                                $q->orWhere('hours', '>', 8);
                            } else {
                                $q->where('hours', '>', 8);
                            }
                            break;
                    }
                }
            });
        }

        // where name search
        if ($title = $this->request->get('title')) {
            $courses->where('courses.title', 'like', "%$title%");
        }

        // with trashed search
        if ($this->request->get('trashed') == 'with') {
            $courses->withTrashed();
        }

        // with trashed search
        if ($this->request->get('trashed') == 'only') {
            $courses->onlyTrashed();
        }

        return $courses;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('courses-table')
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
                    'action' => 'function(){location.href="' . route('course.create') . '"}'
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
            Column::make('title'),
            Column::make('active'),
            Column::make('category', 'categories.name'),
            Column::make('views'),
            Column::make('rating'),
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
        return 'Courses_' . date('YmdHis');
    }
}
