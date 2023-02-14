<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faculty;
use App\Models\Reports;
use App\Models\Subject;
// use Barryvdh\DomPDF\PDF;
use App\Models\CourseLoad;
use App\Models\ReportEvents;
use Illuminate\Http\Request;
use App\Models\AssignmentApprovals;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacultyLoadingExport;
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
            'day_avail' => 'required',
            'hour_avail_from' => 'required',
            'hour_avail_to' => 'required',
        ]);

        foreach ($request->day_avail as $dayavail){
                $array[] = [
                    'day_avail' => Carbon::parse($dayavail)->isoFormat('D'),
                ];
        }

        $dayavail = implode(', ', $request->day_avail);

        // this method is WILD lmao
        $selectValuesString = $request->dayArray;
        $selectValues = json_decode($selectValuesString, true);

        Faculty::where('user_id', $user_id)->update([
            'num_of_subj' => $request->num_of_subj,
            'day_avail' => $selectValues,
            'hour_avail_from' => Carbon::parse($request->hour_avail_from)->isoFormat('h:mm A'),
            'hour_avail_to' => Carbon::parse($request->hour_avail_to)->isoFormat('h:mm A'),
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
            //band aid fix
            $subject = Subject::where(['subject_code' => $courseload->title])->first();
            $events[] = [
                'id' => $courseload->id,
                'curriculum_id' => $courseload->curriculum_id,
                'period' => $courseload->period,
                'title' => $courseload->title,
                'subjectTitle' => $subject->subject_title,
                'description' => $courseload->faculty->name,
                'room' => $courseload->room,
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

    public function fileImport()
    {

    }

    public function fileExport(Request $request)
    {
        $faculty = Faculty::where('name', $request->facultyName)->first();
        
        $courseload = Courseload::where('faculty_id', $faculty->id)->get();

        foreach ($courseload as $cl) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->end_date);
            $subjects = Subject::where('id', $cl->subject_id)->first();
            
            $subject[] = [
                'subject_code' => $subjects->subject_code,
                'subject_title' => $subjects->subject_title,
                'cred_units' => $subjects->cred_units,
                'subj_hours' => $subjects->subj_hours,
                'start' => $start_date->format("D H:i"),
                'end' => $end_date->format("H:i")
            ];
            // dd($subject);
            
        }

        // return view('pdf.loadFacPDF', ['subject' => $subject, 'faculty' => $faculty]);

        // $pdf = App::make('dompdf.wrapper');
        $pdf = App::make('snappy.pdf.wrapper');
        // $pdf -> setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf -> loadView('pdf.loadFacPDF', [
            'subject' => $subject,
            'faculty' => $faculty
        ]);
        return $pdf->download('Approval - ' . $faculty->name . '.pdf');
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->download('invoice.pdf');
        

        // return Excel::download(new FacultyLoadingExport, 'FacultyLoading-collection.xlsx');
    }

    public function fileExport2(Request $request, $id)
    {
        $faculty = Faculty::where('id', $id)->first();
        
        $courseload = Courseload::where('faculty_id', $faculty->id)->get();

        // foreach ($courseload as $cl) {
        //     $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->start_date);
        //     $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->end_date);
        //     $subjects = Subject::where('id', $cl->subject_id)->first();
            
        //     $subject[] = [
        //         'subject_code' => $subjects->subject_code,
        //         'subject_title' => $subjects->subject_title,
        //         'cred_units' => $subjects->cred_units,
        //         'subj_hours' => $subjects->subj_hours,
        //         'start' => $start_date->format("D H:i"),
        //         'end' => $end_date->format("H:i")
        //     ];
        //     // dd($subject);
            
        // }

        $report = Reports::where('faculty_id', $id)
                            ->where('status', 'Approved')
                            ->first();
        
        $reportEvents = ReportEvents::where(['report_id' => $report->id])->get();
        foreach($reportEvents as $reportEvent){
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $reportEvent->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $reportEvent->end_date);
            $subjects = Subject::where('subject_code', $reportEvent->title)->first();

            $subject[] = [
                        'subject_code' => $subjects->subject_code,
                        'subject_title' => $subjects->subject_title,
                        'cred_units' => $subjects->cred_units,
                        'subj_hours' => $subjects->subj_hours,
                        'start' => $start_date->format("D H:i"),
                        'end' => $end_date->format("H:i")
                    ];
        } 
        

        // return view('pdf.loadFacPDF', ['subject' => $subject, 'faculty' => $faculty]);

        // $pdf = App::make('dompdf.wrapper');
        $pdf = App::make('snappy.pdf.wrapper');
        // $pdf -> setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf -> loadView('pdf.facApprovePDF', [
            'subject' => $subject,
            'faculty' => $faculty
        ]);
        return $pdf->download('Approved Schedule - ' . $faculty->name . '.pdf');
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->download('invoice.pdf');
        

        // return Excel::download(new FacultyLoadingExport, 'FacultyLoading-collection.xlsx');
    }
}
