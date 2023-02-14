<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'faculty_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function reportEvents()
    {
        return $this->hasMany(ReportEvents::class);
    }
}
