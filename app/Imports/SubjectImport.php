<?php

namespace App\Imports;

use App\Models\Subject;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToCollection, WithHeadingRow
{
    private $code;
    private $level;
    private $section;

    public function __construct(string $co, string $le, string $sec)
    {
        $this->code = $co;
        $this->level = $le;
        $this->section = $sec;
    }

    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            if ($this->code == $col['curriculum_id'] && 
                $this->level == $col['level'] && 
                $this->section == $col['section'])
            {
                Subject::create([
                    'curriculum_id' => $col['curriculum_id'],
                    'period' => $col['period'],
                    'section' => $col['section'],
                    'level' => $col['level'],
                    'subject_code' => $col['subject_code'],
                    'subject_title' => $col['subject_title'],
                    'cred_units' => $col['cred_units'],
                    'subj_hours' => $col['subj_hours'],
                    'pre_requisite' => $col['pre_requisite'],
                    'co_requisite' => $col['co_requisite'],
                ]);
            };

            
        }
        
    }
}
