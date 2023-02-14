<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BackupImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new FirstSheetBackupImport(),
            1 => new SecondSheetBackupImport(),
            2 => new ThirdSheetBackupImport(),
            3 => new FourthSheetBackupImport(),
            4 => new FifthSheetBackupImport(),
            5 => new SixthSheetBackupImport(),
            6 => new SeventhSheetBackupImport(),
            7 => new EighthSheetBackupImport(),
            8 => new NinthSheetBackupImport(),
        ];
    }
}
