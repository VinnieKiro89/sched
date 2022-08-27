<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\Supply;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $for_interventions = Consultation::doesntHave('doctor_intervention')->where('severe','=', 'severe')->count();
        // $patients = Patient::count();
        // $medicines = Medicine::all();
        // $supplies = Supply::all();

        // $past_consultations = Consultation::with('patient')->latest()->take(5)->get();

        // return view('dashboard.index',compact('patients','for_interventions','medicines','supplies','past_consultations'));

        return view('dashboard');


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
