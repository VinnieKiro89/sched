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
        
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('section', $request->section)
                                ->where('level', $request->level)
                                ->first();

        //$id = $curriculum->id;

        $events['events'] = Subject::where('curriculum_id', $curriculum->id)->where('period', $request->period)->get(["subject_code", "subject_title", "curriculum_id", "period", "selectFaculty"]);
        
        // return view('new', ['subjects' => $subjects, 'courses' => $courses])->render();
        // return view('new', compact('subjects', 'courses', 'curriculum', 'events'))->render();
        return response() -> json($events);
    }

    public function get_event(Request $request)    // redundant?                              
    {
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('section', $request->section)
                                ->where('level', $request->level)
                                ->first();

        $events = Subject::where('curriculum_id', $curriculum->id)->where('period', $request->period)->get();
        
        $subject = Subject::where('subject_code', $request->title)->first();
        $selectFac = $subject->selectFaculty;

        if (!$selectFac){
            $faculty = Faculty::all();
        }else{
            if (count($selectFac) > 1)
            {
                $faculty = Faculty::wherein('id', $subject->selectFaculty)->get();
            }elseif(count($selectFac) <= 1)
            {
                $faculty = Faculty::where('id', $subject->selectFaculty)->get();
            }
        }

        return response() -> json([$events, $faculty]);
    }

    public function get_prefmodal(Request $request) // redundant?                                 
    {
        $subject = Subject::where('subject_code', $request->title)->first();
        $selectFac = $subject->selectFaculty;

        if (!$selectFac){
            $faculty = Faculty::all();
        }else{
            if (count($selectFac) > 1)
            {
                $faculty = Faculty::wherein('id', $subject->selectFaculty)->get();
            }elseif(count($selectFac) <= 1)
            {
                $faculty = Faculty::where('id', $subject->selectFaculty)->get();
            }
        }

        return response() -> json($faculty);
    }

    public function get_cal(Request $request)                                  
    {
        $curriculum = Curriculum::where('course_id',$request->course)
                                ->where('section', $request->section)
                                ->where('level', $request->level)
                                ->first();

        $events = array();
        $course_load = CourseLoad::where(['curriculum_id' => $curriculum->id, 'period' => $request->period])->get();
        foreach($course_load as $courseload){
            $events[] = [
                'id' => $courseload->id,
                'curriculum_id' => $courseload->curriculum_id,
                'period' => $courseload->period,
                'title' => $courseload->title,
                'description' => $courseload->faculty->name,
                'faculty_id' => $courseload->faculty->id,
                'start' => $courseload->start_date,
                'end' => $courseload->end_date,
            ];
        }

        return response()->json($events);
    }

    public function get_pref(Request $request)                                  
    {
        $subject = Subject::where('subject_code', $request->title)->first();
        $selectFac = $subject->selectFaculty;

        if (!$selectFac){
            $faculty = Faculty::all();
        }else{
            if (count($selectFac) > 1)
            {
                $faculty = Faculty::wherein('id', $subject->selectFaculty)->get();
            }elseif(count($selectFac) <= 1)
            {
                $faculty = Faculty::where('id', $subject->selectFaculty)->get();
            }
        }

        return response() -> json($faculty);
    }

    public function store_event(Request $request)
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

        // $start = Carbon::parse($request->start_date);
        // $end = Carbon::parse($request->end_date);

        $date = [new Carbon($request->start_date), new Carbon($request->end_date)];
        $timefrom = Carbon::parse($request->start_date)->isoFormat('HH:mm');
        $timeto = Carbon::parse($request->end_date)->isoFormat('HH:mm');


        // $start = $startnonform->format('Y-m-d');
        // $end = $endnonform->format('Y-m-d');

        // checking for conflict in course loading
        $checks1 = Courseload::where('curriculum_id', $request->curriculum_id)
                                ->where('period', $request->period)
                                ->whereBetween('start_date', $date)
                                ->get();
        
        $checks2 = Courseload::where('curriculum_id', $request->curriculum_id)
                                ->where('period', $request->period)
                                ->whereBetween('end_date', $date)
                                ->get();

        $allevent1 = Courseload::where('curriculum_id', $request->curriculum_id)
                                ->where('period', $request->period)
                                ->get();

        // checking for conflict in faculty loading
        $checks3 = Courseload::where('faculty_id', $request->faculty)
                                ->whereBetween('start_date', $date)
                                ->get();

        $checks4 = Courseload::where('faculty_id', $request->faculty)
                                ->whereBetween('end_date', $date)
                                ->get();

        $allevent2 = Courseload::where('faculty_id', $request->faculty)
                                ->get();

        // checking for conflict in Faculty availability & number of subjects
        $facultycheck = Faculty::where('id', $request->faculty)->first();
        $numberOfSubj = Courseload::where('faculty_id', $request->faculty)->count();

        if(count($checks1) > 0)
        {
            return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
        }elseif(count($checks2) > 0)
        {
            return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
        }
        elseif(count($checks3) > 0)
        {
            return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
        }elseif(count($checks4) > 0)
        {
            return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
        }elseif(!$facultycheck->hour_avail_from)
        {
            return response()->json(['error' => "The selected Faculty member has no designated hour availability yet"], 401);
        }elseif(Carbon::parse($facultycheck->hour_avail_from)->isoFormat('HH:mm') > $timefrom)
        {
            return response()->json(['error' => "Schedule is conflicting with the Faculty's time availability"], 401);
        }elseif(!$facultycheck->hour_avail_to)
        {
            return response()->json(['error' => "The selected Faculty member has no designated hour availability yet"], 401);
        }elseif(Carbon::parse($facultycheck->hour_avail_to)->isoFormat('HH:mm') < $timeto)
        {
            return response()->json(['error' => "Schedule is conflicting with the Faculty's time availability"], 401);
        }elseif(!$facultycheck->num_of_subj)
        {
            return response()->json(['error' => "The selected Faculty member has no designated number of subject availability yet"], 401);
        }elseif($facultycheck->num_of_subj <= $numberOfSubj)
        {
            return response()->json(['error' => "Schedule is conflicting with the Faculty's number of subject availability"], 401);
        }else
        {
            foreach($allevent1 as $allevent) {
                if($allevent->start_date <= $date[0] && $allevent->end_date >= $date[1]){
                    return response()->json(['error' => 'Schedule is conflicting with another existing schedule'], 401);
                }
            }
            foreach($allevent2 as $allevent){
                if($allevent->start_date <= $date[0] && $allevent->end_date >= $date[1]){
                    return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseLoad  $courseLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // is this even working? where do I use this? [That's for the dragging of events, dumbass]
    {
        $date = [new Carbon($request->start_date), new Carbon($request->end_date)];
        $timefrom = Carbon::parse($request->start_date)->isoFormat('HH:mm');
        $timeto = Carbon::parse($request->end_date)->isoFormat('HH:mm');


        // checking for conflict in course loading
        // lmao

        // checking for conflict in faculty loading
        $checks3 = Courseload::where('faculty_id', $request->faculty)
                                ->where('id', '!=' ,$id)
                                ->whereBetween('start_date', $date)
                                ->get();

        $checks4 = Courseload::where('faculty_id', $request->faculty)
                                ->where('id', '!=' ,$id)
                                ->whereBetween('end_date', $date)
                                ->get();

        $allevent2 = Courseload::where('faculty_id', $request->faculty)
                                ->where('id', '!=' ,$id)
                                ->get();

        // checking for conflict in Faculty availability & number of subjects
        $facultycheck = Faculty::where('id', $request->faculty)->first();

        $courseload = CourseLoad::find($id);
        if(! $courseload)
        {
            return response()->json(['error' => 'unable to find event' ], 404);
        }
        else
        {
            if(count($checks3) > 0)
            {
                return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
            }elseif(count($checks4) > 0)
            {
                return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
            }elseif(Carbon::parse($facultycheck->hour_avail_from)->isoFormat('HH:mm') > $timefrom)
            {
                return response()->json(['error' => "Schedule is conflicting with the Faculty's time availability"], 401);
            }elseif(Carbon::parse($facultycheck->hour_avail_to)->isoFormat('HH:mm') < $timeto)
            {
                return response()->json(['error' => "Schedule is conflicting with the Faculty's time availability"], 401);
            }
            else
            {
                foreach($allevent2 as $allevent){
                    if($allevent->start_date <= $date[0] && $allevent->end_date >= $date[1]){
                        return response()->json(['error' => "Schedule is conflicting with the Faculty's existing schedule"], 401);
                    }
                }

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

    public function update2(Request $request, $id) //modal
    {
        

        $courseload = CourseLoad::find($id);
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
