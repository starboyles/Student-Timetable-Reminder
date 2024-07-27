<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class StudentController extends Controller
{
   public function showForm()
   {
       return view('add-student');
   }

   public function addStudent(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'phone_number' => 'required|string|max:20',
           'email' => 'nullable|email|max:255',
           'course_name' => 'required|string|max:255',
           'daily_schedule' => 'required|string|max:255',
           'lecture_venue' => 'required|string|max:255',
           'reminder_time' => 'required|date_format:H:i',
       ]);

       if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }
       $student = new Student();
       $student->name = $request->name;
       $student->phone_number = $request->phone_number;
       $student->email = $request->email;
       $student->course_name = $request->course_name;
       $student->daily_schedule = $request->daily_schedule;
       $student->lecture_venue = $request->lecture_venue;
       $student->reminder_time = $request->reminder_time;
       $student->save();

       return redirect()->back()->with('success', 'Student added successfully.');
   }

   public function sendTimetableReminders(Request $request)
   {
       $currentTime = now()->format('H:i') . ":00";
       $students = Student::whereRaw(
           "TIME_FORMAT(reminder_time, '%H:%i:%s') = ?",
           [$currentTime]
       )->get();
       foreach ($students as $student) {
           $this->placeCallReminder($student);
       }
   }

   private function placeCallReminder($student)
   {
       $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
       $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
       $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

       $client = new Client($twilioAccountSid, $twilioAuthToken);

       $message = "Hi $student->name, this is a reminder to get ready for class: $student->course_name. Daily_schedule: $student->daily_schedule.";
       $client->calls->create(
           $student->phone_number,
           $twilioPhoneNumber,
           ['twiml' => '<Response><Say>  ' . $message  . '.</Say></Response>']
       );
   }
}