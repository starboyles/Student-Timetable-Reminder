<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Reminder System</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Mono', monospace;
            background-color: #000000;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #ffffff;
        }
        .start-screen, .form-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .start-button {
            font-size: 24px;
            padding: 15px 30px;
            background-color: #ffffff;
            color: #000000;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .start-button:hover {
            background-color: #cccccc;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        label {
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            background-color: #ffffff;
            color: #000000;
            border: none;
        }
        input[type="submit"] {
            background-color: #ffffff;
            color: #000000;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #cccccc;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="startScreen" class="start-screen">
            <h1>Student Reminder System</h1>
            <button class="start-button" onclick="showForm()">Start</button>
        </div>

        <div id="formScreen" class="form-screen hidden">
            <h1>Student Reminder Form</h1>
            @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('add-student') }}" method="post">
                @csrf
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required>

                <label for="course_name">Course Name</label>
                <input type="text" id="course_name" name="course_name" required>

                <label for="daily_schedule">Daily Schedule</label>
                <input type="text" id="daily_schedule" name="daily_schedule" required>

                <label for="lecture_venue">Lecture Venue</label>
                <input type="text" id="lecture_venue" name="lecture_venue" required>

                <label for="reminder_time">Reminder Time</label>
                <input type="time" id="reminder_time" name="reminder_time" required>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        function showForm() {
            document.getElementById('startScreen').classList.add('hidden');
            document.getElementById('formScreen').classList.remove('hidden');
        }
    </script>
</body>
</html>