<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Dashboard;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Models\AssignmentApprovals;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::count();
        $courses = Course::count();
        $curricula = Curriculum::count();
        $subjects = Subject::count();
        $approvals = AssignmentApprovals::where('approval', 'Pending')
                                        ->count();

        // $past_consultations = Consultation::with('patient')->latest()->take(5)->get();

        // return view('dashboard.index',compact('patients','for_interventions','medicines','supplies','past_consultations'));

        return view('dashboard', compact('users', 'courses', 'curricula', 'subjects', 'approvals'));


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
     * @param  \App\Models\DashboardController  $dashboardController
     * @return \Illuminate\Http\Response
     */
    public function show(DashboardController $dashboardController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DashboardController  $dashboardController
     * @return \Illuminate\Http\Response
     */
    public function edit(DashboardController $dashboardController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DashboardController  $dashboardController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DashboardController $dashboardController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DashboardController  $dashboardController
     * @return \Illuminate\Http\Response
     */
    public function destroy(DashboardController $dashboardController)
    {
        //
    }
}
