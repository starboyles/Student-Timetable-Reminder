<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 
        'email',
        'phone_number', 
        'course_name',
        'daily_schedule',
        'lecture_venue',
        'reminder_time'
    ];
}