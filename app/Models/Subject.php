<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function specializedFaculties(){
        return $this->belongsToMany(Faculty::class, 'faculty_subject')->withTimestamps();
    }

    public function facultyLoads()
    {
        return $this->hasMany(FacultyLoad::class);
    }
}
