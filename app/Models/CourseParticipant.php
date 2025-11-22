<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseParticipant extends Model
{
    use HasFactory;

    protected $table = 'course_participant';

    protected $fillable = ['participant_id', 'course_id'];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
