<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Faculty;
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
                'period' => $courseload->period,
                'title' => $courseload->title,
                'start' => $courseload->start_date,
                'end' => $courseload->end_date,
            ];
        }

        $faculty = Faculty::all();

        $courses = Course::all();
        $subjects = Subject::all();
        $curricula = Curriculum::all();

        return view('courseload', ['events' => $events, 'courses' => $courses, 'subjects' => $subjects, 'faculties' => $faculty]);
    }                                                                           

    public function get_subjects(Request $request)                                  
    {
        // hope your brand table contain category_id or any name as you wish which act as foreign key
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('section', $request->section)
                                ->where('level', $request->level)
                                ->first();

        //$id = $curriculum->id;

        $events['events'] = Subject::where('curriculum_id', $curriculum->id)->where('period', $request->period)->get(["subject_code", "subject_title", "curriculum_id", "period"]);
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        // return view('new', compact('subjects', 'courses', 'curriculum', 'events'))->render();
        return response() -> json($events);
    }

    public function get_cal(Request $request)                                  
    {
        // hope your brand table contain category_id or any name as you wish which act as foreign key
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('section', $request->section)
                                ->where('level', $request->level)
                                ->first();
        //$subjects = Subject::where('curriculum_id',$curriculum->id)->get();

        //$id = $curriculum->id;
        //dd($request);

        $events = array();
        $course_load = CourseLoad::where(['curriculum_id' => $curriculum->id, 'period' => $request->period])->get();
        foreach($course_load as $courseload){
            $events[] = [
                'id' => $courseload->id,
                'curriculum_id' => $courseload->curriculum_id,
                'period' => $courseload->period,
                'title' => $courseload->title,
                'description' => $courseload->faculty->name,
                'start' => $courseload->start_date,
                'end' => $courseload->end_date,
            ];
        }
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        // return view('newcal', compact('subjects', 'courses', 'curriculum', 'events'))->render();

        return response()->json($events);
    }

    public function get_pref(Request $request)                                  
    {
        $subject = Subject::where('subject_code', $request->title)->first();
        $faculty = Faculty::wherein('id', $subject->selectFaculty)->get();

        // foreach($faculty as $fac){
        //     $events[] = [
        //         'id' => $fac->id,
        //         'name' => $fac->name,
        //     ];
        // }
        
        // $allfaculty = $faculty->all();

        // $faculty = Subject::with('faculty')->where('subject_code', $request->title)->get();

        return response()->json($faculty);
    }

    public function store_event(Request $request)
    {

        $verify = Courseload::where('start_date', Carbon::parse($request->start_date))
                            ->where('end_date', Carbon::parse($request->end_date))->first();

        if($verify != null)
        {
            return response()->json(['error' => 'Incorrect time'], 401);
        }
        elseif(Carbon::parse($request->start_date) >= Carbon::parse($request->end_date)) //this does not work
        {
            return response()->json(['error' => 'Incorrect time', 401]); 
        }
        else
        {
            $request->validate([
                'curriculum_id' => 'required|string',
                'period' => 'required|string',
                'title' => 'required|string',
                // 'day' => 'required|string',
                'faculty' => 'required|string',
                'end_date' => 'required|string|',
                'start_date' => 'required|string|',
                
            ]);

            $checks = Courseload::where('curriculum_id', $request->curriculum_id)
                                    ->where('period', $request->period)
                                    ->get();

            foreach ($checks as $check) 
            {
                if(Carbon::parse($request->start_date) <= $check->start_date && Carbon::parse($request->end_date) > $check->end_date){
                    return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
                }elseif(Carbon::parse($request->start_date) < $check->start_date && Carbon::parse($request->end_date) >= $check->end_date){
                    return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
                }elseif(Carbon::parse($request->start_date) >= $check->start_date && Carbon::parse($request->end_date) <= $check->end_date){
                    return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
                }elseif(Carbon::parse($request->start_date) <= $check->start_date && Carbon::parse($request->end_date) <= $check->end_date){
                    return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
                }
            }

            $newcourseload = new CourseLoad();

            $newcourseload->curriculum_id = $request->curriculum_id;
            $newcourseload->period = $request->period;
            $newcourseload->title = $request->title;
            $newcourseload->faculty_id = $request->faculty;
            $newcourseload->start_date = Carbon::parse($request->start_date);
            $newcourseload->end_date = Carbon::parse($request->end_date);

            $newcourseload -> save();

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
            return response()->json(['error' => 'unable to find event' ], 404);
        }
        else
        {
            $verify = Courseload::where('start_date', '=', Carbon::parse($request->start_date))
                            ->where('end_date', '=', Carbon::parse($request->end_date))->first();

            if($verify != null)
            {
                return redirect()->route('courseload.index')->with('deleted', 'error.');
            }
            elseif(Carbon::parse($request->start_date) > Carbon::parse($request->end_date))
            {
                // i do not know what this is for...
            }
            else
            {
                // $day = $request->day;
                // $start = $request->
                // $end
                if($request->curriculum_id != null)
                {
                    $courseload->update([
                        'title' => $request->newTitle,
                        'faculty_id' => $request->faculty,
                        'start_date' => Carbon::parse($request->start_date),
                        'end_date' => Carbon::parse($request->end_date),
                    ]);
                }
                else 
                {
                    $courseload->update([
                        'start_date' => Carbon::parse($request->start_date),
                        'end_date' => Carbon::parse($request->end_date),
                    ]);
                }
        
                return response()->json('Event Updated');
            }
        }
    }

    public function update2(Request $request)
    {
        

        $courseload = CourseLoad::find($request->id);
        if(! $courseload)
        {
            return response()->json([
                'error' => 'unable to find event'
            ], 404);
        }
        else
        {
  

                // $courseload = CourseLoad::find($request->id);
                $courseload->update([
                    'title' => $request->newTitle,
                    'faculty_id' => $request->newFaculty,
                    'start_date' => Carbon::parse($request->start_date),
                    'end_date' => Carbon::parse($request->end_date),
                ]);
                return response()->json('Event Updated');
                
            
        }
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
