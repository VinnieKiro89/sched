<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    use SoftDeletes;

    protected $fillable = [
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
        // 'selectFaculty',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'selectFaculty' => 'array',
    ];

    public function courseLoad()
    {
        return $this->hasMany(CourseLoad::class);
    }

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

