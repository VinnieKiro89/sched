<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportEvents extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function report()
    {
        return $this->belongsTo(Reports::class);
    }
}
