<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Subject;
use App\Models\CourseLoad;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Acaronlex\LaravelCalendar\Calendar;

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
                                ->where('section', $request->section)
                                ->first();
        $subjects = Subject::where('curriculum_id',$curriculum->id)->get();

        //$id = $curriculum->id;

        $courses = Course::all();

        // return response() -> json($subjects);
        // return json_encode($subjects);

        // $events = array();
        // $course_load = CourseLoad::where('curriculum_id',$curriculum->id)->get();
        // foreach($course_load as $courseload){
        //     $events[] = [
        //         'id' => $courseload->id,
        //         'curriculum_id' => $courseload->curriculum_id,
        //         'title' => $courseload->title,
        //         'start' => $courseload->start_date,
        //         'end' => $courseload->end_date,
        //     ];
        // }

        $events['events'] = Subject::where('curriculum_id',$curriculum->id)->get(["subject_code", "subject_title", "curriculum_id"]);
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        // return view('new', compact('subjects', 'courses', 'curriculum', 'events'))->render();
        return response() -> json($events);
    }

    public function get_cal(Request $request)                                  
    {
        // hope your brand table contain category_id or any name as you wish which act as foreign key
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('level', $request->level)
                                ->where('section', $request->section)
                                ->first();
        $subjects = Subject::where('curriculum_id',$curriculum->id)->get();

        //$id = $curriculum->id;

        $courses = Course::all();

        // return response() -> json($subjects);
        // return json_encode($subjects);

        // $eventss = [];
        // $course_load = CourseLoad::where('curriculum_id',$curriculum->id)->get();
        // foreach($course_load as $courseload){
        //     $eventss[] = Calendar::event(
        //         $courseload->title,
        //         false,
        //         $courseload->start_date,
        //         $courseload->end_date,
        //         $courseload->curriculum_id
        //     );
        // }

        // $calendar = new Calendar();
        // $calendar->addEvents($eventss);
        // $calendar->setOptions([
        //     'type' => 'timeGridWeek',
        //     'slotMinTime' => '6:00:00',
        //     'slotMaxTime' => '22:00:00',
        //     'allDaySlot' => false,
        //     'expandRows' => true,
        //     'dayHeaderFormat' => [ 'weekday' => 'long' ],
        //     'selectable' => true,
        //     'selectHelper' => true,
        //     'editable' => true,
        //     'droppable' => true,
        //     'eventOverlap' => false,
        // ]);
        // $calendar->setId('1');
        // $calendar->setCallbacks([
        //     'select' => 'function(selectionInfo){}',
        //     'eventClick' => 'function(event){}'
        // ]);
        

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
        // return view('newcal', compact('subjects', 'courses', 'curriculum', 'events'))->render();

        return response()->json($events);
    }

    public function store_event(Request $request)
    {
        $verify = Courseload::where('start_date', '=', Carbon::parse($request->start_date))
                            ->where('end_date', '=', Carbon::parse($request->end_date))->first();

        if($verify != null)
        {
            return redirect()->route('courseload.index')->with('deleted', 'lmao error.');
        }
        elseif(Carbon::parse($request->start_date) > Carbon::parse($request->end_date))
        {
            
        }
        else
        {
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
    public function update(Request $request, $id)
    {
        $courseload = CourseLoad::find($id);
        if(! $courseload)
        {
            return response()->json([
                'error' => 'unable to find event'
            ], 404);
        }

        $courseload->update([
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);

        return response()->json('Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $courseload = CourseLoad::find($id);
        if(! $courseload)
        {
            return response()->json([
                'error' => 'unable to find event'
            ], 404);
        }

        $courseload->delete();
        return $id;
        
        // return redirect()->route('courseload.index')->with('deleted', 'Subject Deleted.');
    }
}
