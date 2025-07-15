<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;



    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }


    public function sections(){
        return $this->hasMany(Section::class);
    }
}
