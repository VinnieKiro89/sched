<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\ReportEvents;
use Illuminate\Http\Request;

use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;



class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Reports::all();

        $events = array();
        $reportEvents = ReportEvents::all();
        foreach($reportEvents as $reportEvent){
            $events[] = [
                'id' => $reportEvent->id,
                'report_id' => $reportEvent->report_id,
                'curriculum_id' => $reportEvent->curriculum_id,
                'period' => $reportEvent->period,
                'title' => $reportEvent->title,
                'start' => $reportEvent->start_date,
                'end' => $reportEvent->end_date,
                'status' => $reportEvent->status
            ];
        }

        return view('report', ['reports'=>$reports, 'events'=>$events]);
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
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Reports::where('id', $id)->first();


        $events = array();
        $reportEvents = ReportEvents::where(['report_id' => $id])->get();
        foreach($reportEvents as $reportEvent){
            $events[] = [
                'id' => $reportEvent->id,
                'report_id' => $reportEvent->report_id,
                'curriculum_id' => $reportEvent->curriculum_id,
                'period' => $reportEvent->period,
                'title' => $reportEvent->title,
                'start' => $reportEvent->start_date,
                'end' => $reportEvent->end_date,
                'status' => $reportEvent->status
            ];
        } 

        // return response()->json($events);
        return view ('viewreport', ['events' => $events, 'report' => $report]);
    }

    public function schedule($id)
    {
        $report = Reports::where('faculty_id', $id)
                            ->where('status', 'Approved')
                            ->first();
        
        if(!$report){
            $events[] = null;
            return view ('viewschedule', ['report' => $report, 'events' => $events]);
        }else{
            $events = array();
            $reportEvents = ReportEvents::where(['report_id' => $report->id])->get();
            foreach($reportEvents as $reportEvent){
                $events[] = [
                    'id' => $reportEvent->id,
                    'report_id' => $reportEvent->report_id,
                    'curriculum_id' => $reportEvent->curriculum_id,
                    'period' => $reportEvent->period,
                    'title' => $reportEvent->title,
                    'start' => $reportEvent->start_date,
                    'end' => $reportEvent->end_date,
                    'status' => $reportEvent->status
                ];
            } 
        }

        // return response()->json($events);
        return view ('viewschedule', ['events' => $events, 'report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reports $reports)
    {
        //
    }

    public function fileImport()
    {

    }

    public function fileExport()
    {
        return Excel::download(new ReportsExport, 'reports-collection.xlsx');
    }
}
