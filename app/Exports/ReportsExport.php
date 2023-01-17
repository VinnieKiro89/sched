<?php

namespace App\Exports;

use App\Models\Reports;
use App\Models\ReportEvents;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Faculty',
            'Status',
            'Subjects',
        ];
    }

    public function map($reports): array
    {
        $subjects = ReportEvents::where('report_id', $reports->id)->get();
        foreach($subjects as $subject)[
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->start_date),
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->end_date),
            $facultySubject[] = [
                $subject->title,
                $start_date->format("D H:i") . ' to ' . $end_date->format("H:i"),

            ],
        ];

        return [
            $reports->faculty->name,
            $reports->status,
            $facultySubject
            
        ];

    }

    public function collection()
    {
        // return Reports::with('Faculty')->select('faculty_id', 'status')->get();
        return Reports::with('Faculty')->get();
    }
}
