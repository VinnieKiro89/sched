<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function courseload()
    {
        return $this->hasMany(CourseLoad::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }

    public function assignmentApproval()
    {
        return $this->hasMany(AssignmentApprovals::class);
    }

    public function reports()
    {
        return $this->hasMany(Reports::class);
    }

    public function reportEvents()
    {
        return $this->hasMany(reportEvents::class);
    }
}
