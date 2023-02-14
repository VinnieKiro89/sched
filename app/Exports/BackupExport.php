<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Reports;
use App\Models\Subject;
use App\Models\CourseLoad;
use App\Models\Curriculum;
use App\Models\ReportEvents;
use App\Models\AssignmentApprovals;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BackupExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    private $int;

    public function __construct(int $i)
    {
        $this->int = $i;
    }

    public function headings(): array
    {
        if($this->int == 1){
            return [
                'id',
                'faculty_id',
                'approval',
                'created_at',
                'updated_at',
            ];
        }elseif($this->int == 2){
            return [
                'id' ,
                'course_code' ,
                'description' ,
                'created_at' ,
                'updated_at' ,
            ];
        }elseif($this->int == 3){
            return [
                'id',
                'curriculum_id',
                'period',
                'title',
                'start_date',
                'end_date',
                'room',
                'faculty_id',
                'subject_id',
                'created_at',
                'updated_at',
            ];
            
        }elseif($this->int == 4){
            return [
                'id',
                'course_id',
                'level',
                'section',
                'created_at',
                'updated_at',
            ];
        }elseif($this->int == 5){
            return [
                'id',
                'user_id',
                'name',
                'undergraduate',
                'graduate',
                'post_graduate',
                'professional_license',
                'name_of_company',
                'length_of_teaching',
                'field',
                'subj_taught',
                'nature_of_appt',
                'status',
                'email',
                'contact',
                'num_of_subj' ,
                'day_avail',
                'hour_avail_from',
                'hour_avail_to',
                'created_at',
                'updated_at',
            ];
        }elseif($this->int == 6){
            return [
                'id',
                'faculty_id',
                'status',
                'created_at',
                'updated_at',
            ];
        }elseif($this->int == 7){
            return [
                'id',
                'report_id',
                'curriculum_id',
                'period',
                'title',
                'start_date',
                'end_date',
                'status',
                'created_at',
                'updated_at',
            ];
        }elseif($this->int == 8){
            return [
                'id',
                'curriculum_id',
                'period',
                'section',
                'level',
                'subject_code',
                'subject_title',
                'cred_units',
                'subj_hours',
                'pre_requisite',
                'co_requisite',
                'selectFaculty',
                'created_at',
                'updated_at',
            ];
        }else{
            return [
                'id', 
                'fname',
                'username',
                'role',
                'password',
                'created_at',
                'updated_at',
            ];
        }
        
    }

    public function collection()
    {
        // This is ugly, there has to be a better way on doing this, but like all things, this is a temporary band-aid fix
        if($this->int == 1){
            return AssignmentApprovals::all();
        }elseif($this->int == 2){
            return Course::all();
        }elseif($this->int == 3){
            return CourseLoad::all();
        }elseif($this->int == 4){
            return Curriculum::all();
        }elseif($this->int == 5){
            return Faculty::all();
        }elseif($this->int == 6){
            return Reports::all();
        }elseif($this->int == 7){
            return ReportEvents::all();
        }elseif($this->int == 8){
            return Subject::all();
        }else{
            return User::all();
        }
    }
}