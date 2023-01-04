<?php

namespace App\Http\Controllers;

use App\Model\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all();
        return view('subject',['subjects'=>$subject]);
    }

    public function selectsubject(Curriculum $curriculum) // 1
    {

        $faculties = Faculty::all();
        $subjects = Subject::where('curriculum_id', $curriculum->id)->get();
        $id = $curriculum->id;
        $code = $curriculum->course->course_code;
        $section = $curriculum->section;
        $period = $curriculum->period;
        $level = $curriculum->level;
        
        return view('subject', compact('subjects', 'id', 'code', 'section', 'period', 'level', 'faculties'));
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

        $this->validate($request,[
            'curriculum_id' => 'required',
            'period' => 'required',
            'section' => 'required',
            'level' => 'required',
            'subject_code' => 'required',
            'subject_title' => 'required',
            'cred_units' => 'required',
            'subj_hours' => 'required',
        ]);

        

        $subject = new Subject();

        $subject->curriculum_id = $request->input('curriculum_id');
        $subject->period = $request->input('period');
        $subject->level = $request->input('level');
        $subject->section = $request->input('section');
        $subject->subject_code = $request->input('subject_code');
        $subject->subject_title = $request->input('subject_title');
        $subject->cred_units = $request->input('cred_units');
        $subject->subj_hours = $request->input('subj_hours');
        $subject->pre_requisite = $request->input('pre-requisite');
        $subject->co_requisite = $request->input('co-requisite');

        $subject->save();
        
        //return redirect()->route('curriculum.index')->with('success', 'Subject Added Successfully.');
        return redirect()->back()->with('success', 'Subject Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        {

            Subject::where('id',$request->id)->update([
                'subject_code'=>$request->subject_code,
                'subject_title'=>$request->subject_title,
                'cred_units'=>$request->cred_units,
                'pre_requisite'=>$request->pre_requisite,
                'co_requisite'=>$request->co_requisite,
            ]);
    
            // DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
            $course = Subject::findorfail($request->id);
            // $course->assignRole($request->role);
    
            return redirect()->back()->with('updated', 'Update Success!');
        }
    }

    public function updateFaculty(Request $request)
    {
        {

            Subject::where('id',$request->id)->update([
                'selectFaculty'=>$request->selectFaculty,
            ]);
    
            // DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
            $course = Subject::findorfail($request->id);
            // $course->assignRole($request->role);
    
            return redirect()->back()->with('updated', 'Update Success!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findorfail($id);
        $subject->delete();
        
        return redirect()->back()->with('deleted', 'Curriculum Deleted!');
    }
}
