<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faculty;
use App\Models\CourseLoad;
use Illuminate\Http\Request;
use App\Models\AssignmentApprovals;
use SebastianBergmann\CodeCoverage\Report\Html\Facade;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculty = Faculty::all();
        return view('Faculty.faculty',['faculties'=>$faculty]);
    }

    // idk what im doing (1)
    public function view($id)
    {
        $faculty = Faculty::findorfail($id);
        return view('faculty.viewfaculty', compact('faculty'));
    }

    public function viewonly($user_id)
    {
        $faculty = Faculty::where('user_id', $user_id)->first();
        return view('faculty.viewfaculty', compact('faculty'));
    }

    // idk what im doing
    public function add()
    {
        return view('faculty.addfaculty');
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
        // dd($request);
        $this->validate($request,[
            // 'name' => 'required',
            // 'undergraduate' => 'required',
            // 'graduate' => 'required',
            // 'post_graduate' => 'required',
            // 'professional_license' => 'required',
            // 'name_of_company' => 'required',
            // 'length_of_teaching' => 'required',
            // 'field' => 'required',
            // 'subj_taught' => 'required',
            // 'nature_of_appt' => 'required',
            // 'status' => 'required',
            // 'email' => 'required',
            // 'contact' => 'required',
        ]);

        $faculty = new Faculty();

        $faculty->name = $request->input('name');
        $faculty->undergraduate = $request->input('undergraduate');
        $faculty->graduate = $request->input('graduate');
        $faculty->post_graduate = $request->input('post_graduate');
        $faculty->professional_license = $request->input('professional_license');
        $faculty->name_of_company = $request->input('name_of_company');
        $faculty->length_of_teaching = $request->input('length_of_teaching');
        $faculty->field = $request->input('field');
        $faculty->subj_taught = $request->input('subj_taught');
        $faculty->nature_of_appt = $request->input('nature_of_appt');
        $faculty->status = $request->input('status');
        $faculty->email = $request->input('email');
        $faculty->contact = $request->input('contact');

        $faculty->save();
        
        return redirect()->route('faculty.index')->with('success', 'Faculty Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = Faculty::findorfail($id);
        return view('faculty.editfaculty')->with('faculty', $faculty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Faculty::where('id',$id)->update([
            'name'=>$request->name,
            'undergraduate'=>$request->undergraduate,
            'graduate'=>$request->graduate,
            'post_graduate'=>$request->post_graduate,
            'professional_license'=>$request->professional_license,
            'name_of_company'=>$request->name_of_company,
            'length_of_teaching'=>$request->length_of_teaching,
            'field'=>$request->field,
            'subj_taught'=>$request->subj_taught,
            'nature_of_appt'=>$request->nature_of_appt,
            'status'=>$request->status,
            'email'=>$request->email,
            'contact'=>$request->contact,
        ]);

        // DB::table('model_has_roles')->where('model_id',$request->id)->delete();

        $course = Faculty::findorfail($request->id);
        // $course->assignRole($request->role);

        return redirect()->route('faculty.index')->with('updated', 'Update Success!');
    }

    public function updateSubjTime(Request $request, $user_id)
    {
        $this->validate($request,[
            'num_of_subj' => 'required',
            'hour_avail_from' => 'required',
            'hour_avail_to' => 'required',
        ]);

        Faculty::where('user_id', $user_id)->update([
            'num_of_subj' => $request->num_of_subj,
            'hour_avail_from' => Carbon::parse($request->hour_avail_from)->isoFormat('hh:mm A'),
            'hour_avail_to' => Carbon::parse($request->hour_avail_to)->isoFormat('hh:mm A'),
        ]);

        $faculty = Faculty::where('user_id', $user_id)->first();
        return view('faculty.viewfaculty', compact('faculty'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::findorfail($id);
        $faculty->delete();
        
        return redirect()->route('faculty.index')->with('deleted', 'Faculty Deleted!');
    }

    // rest of functions here are for Faculty Loading

    public function load()
    {
        $faculty = Faculty::all();
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

        return view('Faculty.loadfaculty', ['faculties' => $faculty, 'events' => $events]);
    }

    public function facultyLoad(Request $request)
    {
        $faculty = Faculty::where('name',$request->faculty)
                                ->first();

        $events = array();
        $course_load = CourseLoad::where(['faculty_id' => $faculty->id])->get();
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

        return response()->json($events);
    }

    public function facultyLoadApproval(Request $request)
    {
        $faculty = Faculty::where('name',$request->faculty)
                                ->first();

        $approvals = AssignmentApprovals::where('faculty_id', $faculty->id)
                                        ->where('approval', 'Pending')
                                        ->first();

        if ($approvals != null) {
            $approvalWaitResult = '1';
        } elseif ($approvals == null ) {
            $approvalWaitResult = '0';
        }

        return response($approvalWaitResult);
    }
}
