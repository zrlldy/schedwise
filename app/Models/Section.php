<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;



    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }


    // public function subjects()
    // {
    //     return $this->belongsToMany(Subject::class, 'section_subject');
    // }
}
