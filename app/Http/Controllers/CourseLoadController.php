<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Subject;
use App\Models\CourseLoad;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CourseLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function index()
    {
        // obob fullcalendar di nagana >:( || nagana nmn ata
        $events = array();
        $course_load = CourseLoad::all();
        foreach($course_load as $courseload){
            $events[] = [
                'id' => $courseload->id,
                'curriculum_id' => $courseload->curriculum_id,
                'title' => $courseload->title,
                'start' => $courseload->start_date,
                'end' => $courseload->end_date,
            ];
        }

        $courses = Course::all();
        $subjects = Subject::all();
        $curricula = Curriculum::all();

        return view('courseload', ['events' => $events, 'courses' => $courses, 'subjects' => $subjects]);
    }                                                                           

    public function get_subjects(Request $request)                                  
    {
        // hope your brand table contain category_id or any name as you wish which act as foreign key
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('level', $request->level)
                                ->where('period', $request->period)
                                ->first();
        $subjects = Subject::where('curriculum_id',$curriculum->id)->get();

        //$id = $curriculum->id;

        $courses = Course::all();

        // return response() -> json($subjects);
        // return json_encode($subjects);

        $events = array();
        $course_load = CourseLoad::where('curriculum_id',$curriculum->id)->get();
        foreach($course_load as $courseload){
            $events[] = [
                'id' => $courseload->id,
                'curriculum_id' => $courseload->curriculum_id,
                'title' => $courseload->title,
                'start' => $courseload->start_date,
                'end' => $courseload->end_date,
            ];
        }
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        return view('new', compact('subjects', 'courses', 'curriculum', 'events'))->render();
    }

    public function store_event(Request $request)
    {
        $verify = Courseload::where('start_date', '=', Carbon::parse($request->start_date))
                            ->where('end_date', '=', Carbon::parse($request->end_date))->first();

        if($verify != null)
        {
            return view('courseload')->with('deleted', 'lmao error.');
        }

        $request->validate([
            'curriculum_id' => 'required|string',
            'title' => 'required|string',
            'day' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        $newcourseload = CourseLoad::create([
            'curriculum_id' => $request->curriculum_id,
            'title' => $request->title,
            // 'day' => $request->day,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);

        return response()->json($newcourseload);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function show(CourseLoad $courseLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseLoad $courseLoad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseLoad $courseLoad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseLoad $courseLoad)
    {
        //
    }
}
