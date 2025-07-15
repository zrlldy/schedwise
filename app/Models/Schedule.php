<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;



    public function facultyLoad()
    {
        return $this->belongsTo(FacultyLoad::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }

    // public function academicTerm()
    // {
    //     return $this->belongsTo(AcademicTerm::class);
    // }

    public function timeslot(){
        return $this->belongsTo(Timeslot::class);
    }



}
