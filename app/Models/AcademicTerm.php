<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicTerm extends Model
{
    use HasFactory;

    public function facultyLoads()
    {
        return $this->hasMany(FacultyLoad::class);
    }
}
