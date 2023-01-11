<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLoad extends Model
{
    use HasFactory;

    protected $fillable = ['curriculum_id', 'title', 'faculty_id', 'day', 'start_date', 'end_date'];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'curriculum_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
