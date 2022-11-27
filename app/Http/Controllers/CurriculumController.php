<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curriculums = Curriculum::with('subjects')->get();
        //dd($curriculums);
        return view('curriculum', compact('curriculums'));
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
            'course_id' => 'required',
            'section' => 'required',
            'level' => 'required',
        ]);

        $curriculum = new Curriculum();

        $curriculum->course_id = $request->input('course_id');
        $curriculum->section = $request->input('section');
        $curriculum->level = $request->input('level');

        $curriculum->save();
        
        return redirect()->route('curriculum.index')->with('success', 'Curriculum Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        {

            Curriculum::where('id',$request->id)->update([
                'course_code'=>$request->course_code,
                'section'=>$request->section,
                'level'=>$request->level,
            ]);
    
            // DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
            $course = Curriculum::findorfail($request->id);
            // $course->assignRole($request->role);
    
            return redirect()->route('curriculum.index')->with('updated', 'Update Success!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curriculum = Curriculum::findorfail($id);
        $curriculum->delete();
        
        return redirect()->route('curriculum.index')->with('deleted', 'Curriculum Deleted!');
    }
}
