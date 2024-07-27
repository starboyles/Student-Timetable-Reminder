<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'showForm'])->name('show-form');
Route::post('/add-student', [StudentController::class, 'addStudent'])->name('add-student');
Route::get('/send-timetable-reminders', [StudentController::class, 'sendTimetableReminders'])
    ->name('send-timetable-reminders');