<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'instructor', 'description', 'duration'];

    public function enrollments()
    {
        return $this->hasMany(CourseParticipant::class, 'course_id');
    }
}
