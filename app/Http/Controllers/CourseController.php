<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Curriculum;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();
        return view('course',['courses'=>$course]);
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
        // $course = Course::create([
        //     'course_code'=>$request->course_code,
        //     'description'=>$request->description,
        // ]);

        // $course->assignRole($request->role);

        $this->validate($request,[
            'course_code' => 'required',
            'description' => 'required',
        ]);

        $course = new Course;

        $course->course_code = $request->input('course_code');
        $course->description = $request->input('description');

        $course->save();
        
        return redirect()->route('course.index')->with('success', 'Course Added Successfully.');
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

        Course::where('id',$request->id)->update([
            'course_code'=>$request->course_code,
            'description'=>$request->description,
        ]);

        // DB::table('model_has_roles')->where('model_id',$request->id)->delete();

        $course = Course::findorfail($request->id);
        // $course->assignRole($request->role);

        return redirect()->route('course.index')->with('updated', 'Update Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findorfail($id);
        Curriculum::where('course_id',$id)->delete();
        $course->delete();
        
        return redirect()->route('course.index')->with('deleted', 'Course Deleted!');
    }
}
