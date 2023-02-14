<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BackupExportMultiSheet implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        // $sheets = [
        //     '1' => AssignmentApprovals::all(),
        //     '2' => Course::all(),
        //     '3' => CourseLoad::all(),
        //     '4' => Curriculum::all(),
        //     '5' => Faculty::all(),
        //     '6' => Reports::all(),
        //     '7' => ReportEvents::all(),
        //     '8' => Subject::all(),
        //     '9' => User::all()
        // ];

        $sheets = [];

        for ($i = 1; $i <= 9; $i++) {
            $sheets[] = new BackupExport($i);
        }

        return $sheets;
    }
}

