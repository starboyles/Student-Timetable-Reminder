<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('add-student');
});
Route::get('/add-student', [StudentController::class, 'addStudentForm']);
Route::post('/add-student', [StudentController::class, 'addStudent']);
Route::get('/send-reminder', [StudentController::class, 'sendReminder']);
Route::get('/send-timetable-reminders', [StudentController::class, 'sendTimetableReminders'])
    ->name('send-timetable-reminders');