<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursatyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show a listing of user courses.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::with('category')->paginate(abs(request('per_page', 10)));

        return $this->success($courses);
    }

    /**
     * Show a listing of available categories.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories(Request $request)
    {
        $categories = Category::paginate(abs(request('per_page', 10)));

        return $this->success($categories);
    }
}
