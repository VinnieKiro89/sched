<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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
            'course_code' => 'required',
            'period' => 'required',
            'level' => 'required',
            'subject_code' => 'required',
            'subject_title' => 'required',
            'cred_units' => 'required',
        ]);

        $subject = new Subject();

        $subject->course_code = $request->input('course_code');
        $subject->period = $request->input('period');
        $subject->level = $request->input('level');
        $subject->subject_code = $request->input('subject_code');
        $subject->subject_title = $request->input('subject_title');
        $subject->cred_units = $request->input('cred_units');
        $subject->pre_requisite = $request->input('pre-requisite');
        $subject->co_requisite = $request->input('co-requisite');

        $subject->save();
        
        return redirect()->route('curriculum.index')->with('success', 'Subject Added Successfully.');
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
    
            return redirect()->route('subject.index')->with('updated', 'Update Success!');
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
        
        return redirect()->route('subject.index')->with('deleted', 'Curriculum Deleted!');
    }
}
