<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Subject::class, 'faculty_subject')->withTimestamps();
    }
    public function facultyLoads(){
        return $this->hasMany(FacultyLoad::class);
    }
}
