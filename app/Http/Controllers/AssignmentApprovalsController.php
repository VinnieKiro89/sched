<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\CourseLoad;
use Illuminate\Http\Request;
use App\Models\AssignmentApprovals;

class AssignmentApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvals = AssignmentApprovals::where('approval', 'Pending')->get();

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

        return view('approval', ['events' => $events, 'approvals' => $approvals]);
    }

    public function recall()
    {
        $approvals = AssignmentApprovals::where('approval', 'Pending')->get();
        $events[] = [];

        if (! $approvals) {
            $events[] = [];
        } else {
            foreach($approvals as $approval){
                $events[] = [
                    'name' => $approval->faculty->name,
                ];
            }
        }
        
        return response()->json($events);
        
        
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
        $faculty = Faculty::where('name', $request->faculty)->first();
        // my brain doesn't work, so band aid fix
        
        $approvals = new AssignmentApprovals();

        $approvals->faculty_id = $faculty->id;
        $approvals->approval = 'Pending';

        $approvals->save();

        // return response()->with('success', 'Approval Sent');
        return response('Approved');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentApprovals  $assignmentApprovals
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentApprovals $assignmentApprovals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentApprovals  $assignmentApprovals
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentApprovals $assignmentApprovals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignmentApprovals  $assignmentApprovals
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $faculty = Faculty::where('name', $request->faculty)->first();

        AssignmentApprovals::where('faculty_id', $faculty->id)
                                        ->where('approval', 'Pending')
                                        ->update([
                                            'approval' => 'Approved',
                                        ]);

        return response('Approved');
    }

    public function decline(Request $request)
    {
        $faculty = Faculty::where('name', $request->faculty)->first();

        AssignmentApprovals::where('faculty_id', $faculty->id)
                                        ->where('approval', 'Pending')
                                        ->update([
                                            'approval' => 'Declined',
                                        ]);

        return response('Declined');
    }
    // Honestly, I think I can combine approve and decline functions

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentApprovals  $assignmentApprovals
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentApprovals $assignmentApprovals)
    {
        //
    }
}
