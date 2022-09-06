<?php

namespace App\Http\Controllers;

use App\Models\CourseLoad;
use App\Models\Subject;
use App\Models\Course;
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
        // obob fullcalendar di nagana >:(
        $events = array();
        $subjects = Subject::all();
        foreach($subjects as $subject){
            $events[] = [
                'code' => $subject->subject_code,
                'title' => $subject->subject_title,
            ];
        }

        $courses = Course::all();
        $curricula = Curriculum::all();

        return view('courseload', ['subjects' => $subjects, 'courses' => $courses]);
    }                                                                           

    public function get_subjects(Request $request)                                  
    {
        // hope your brand table contain category_id or any name as you wish which act as foreign key
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('level', $request->level)
                                ->where('period', $request->period)
                                ->first();
        $subjects = Subject::where('curriculum_id',$curriculum->id)->get();

        $courses = Course::all();

        // return response() -> json($subjects);
        // return json_encode($subjects);
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        return view('new', compact('subjects', 'courses'))->render();
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
