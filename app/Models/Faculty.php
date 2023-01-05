<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

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
