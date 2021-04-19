<?php

namespace App\Http\Controllers\Site;

use App\DataTables\CoursesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CourseRequest;
use App\Models\Course;

class CourseController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('pages.course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.course.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $record = $request->all();

        $course = Course::create($record);

        return $this->success($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $course->load('category');

        return view('pages.course.form', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $record = $request->validated();

        $course->update($record);

        return $this->success($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        if ($c = $course->trashed()) {
            $course->restore();
        } else {
            $course->delete();
        }

        return back()->withSuccess('Record ' . ($c ? 'restored' : 'deleted') . ' successfully.');
    }
}
