<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .exam-header {
            background-color: #2196F3;
            color: white;
            padding: 15px;
            font-size: 18px;
        }
        .container-box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .question-box {
            border: 1px solid #007bff;
            padding: 0;
            margin: 5px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            flex: 1 0 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px; 
        }

                .question-box a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            border-radius: inherit;
            text-decoration: none;
            outline: none; 
            border: none; 
        }

        .btn-success {
            background-color:#87CEFA; 
            color: black;
        }
        .question-box:hover {
            background-color: #90EE90;
        }
        .question-container {
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid black;
        }
        .question-section-title {
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
            color: #333;
        }
        .questions-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content:flex-start;
        gap: 10px; 
    }

    .question-box {
        width: calc(10% - 10px); 
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .question-box a {
        width: 100%;
        height: 100%;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
    }
        .time-remaining {
            font-weight: bold;
            color: #ff5722;
        }
        .btn-submit {
            margin-top: 10px;
        }
        .alert-info {
            font-size: 16px;
        }
        .no-underline {
            text-decoration: none;
            color: inherit;
        }        

    </style>
</head>
<body>

    
<!-- Header -->
<!-- Header -->
<div class="exam-header d-flex justify-content-between align-items-center">
    <h3>APS-KLC UBT Trail Exam</h3>
    <div class="user-name d-flex align-items-center">
        <span>{{ auth()->user()->username }}</span>
        
        @if(auth()->user()->image) <!-- Check if the student has an image -->
            <img src="{{ Storage::url(auth()->user()->image) }}" alt="Student Image" class="student-profile-img" style="width: 30px; height: 30px; border-radius: 50%; margin-left: 8px;">
        @else
            <i class="fas fa-user-circle" style="margin-left: 8px;"></i> <!-- Default icon if no image -->
        @endif
    </div>
</div>

<br>
<h3 class="text-center">Exam Title: {{ $examTitle }}</h3>

<!-- Main Container -->
<div class="container container-box">

<!-- Info Bar -->
    <div class="row">
        <div class="col-md-3">
            <div class="alert alert-info text-center">
                Total Questions: <strong>{{ $totalQuestions }}</strong>
            </div>
        </div>

    <div class="col-md-3">
        <div class="alert alert-info text-center">
            Solved: <strong>{{ $questions->filter(function($question) {
                return DB::table('user_answers')->where('user_id', Auth::id())->where('question_id', $question->id)->exists();
            })->count() }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="alert alert-info text-center">
            Unsolved: <strong>{{ $totalQuestions - $questions->filter(function($question) {
                return DB::table('user_answers')->where('user_id', Auth::id())->where('question_id', $question->id)->exists();
            })->count() }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="alert alert-info text-center">
            Time Remaining: <strong class="time-remaining" id="timer"></strong>
        </div>
    </div>
      
</div>

<div class="row">
    <!-- Reading Questions Section -->
    <div class="col-md-6">
        <div class="question-container">
            <h5 class="question-section-title">Reading Questions</h5>
            <div class="questions-wrapper">
                @foreach ($questions as $question)
                    @if ($question->question_number <= 20)
                        @php
                            $isAnswered = DB::table('user_answers')
                                ->where('user_id', Auth::id())
                                ->where('question_id', $question->id)
                                ->exists();
                        @endphp
                        <a href="{{ route('student.showQuestion', ['quiz_id' => $question->quiz_id, 'question_number' => $question->question_number]) }}"
                           class="btn question-button {{ $isAnswered ? 'btn-success' : 'btn-outline-secondary' }}">
                            {{ $question->question_number }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Listening Questions Section -->
    <div class="col-md-6">
        <div class="question-container">
            <h5 class="question-section-title">Listening Questions</h5>
            @if (strcasecmp(trim($examTitle), 'Color Vision') === 0)
                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                    No Listening Questions
                </div>
            @else
                <div class="questions-wrapper">
                    @foreach ($questions as $question)
                        @if ($question->question_number > 20)
                            @php
                                $isAnswered = DB::table('user_answers')
                                    ->where('user_id', Auth::id())
                                    ->where('question_id', $question->id)
                                    ->exists();
                            @endphp
                            <a href="{{ route('student.showQuestion', ['quiz_id' => $question->quiz_id, 'question_number' => $question->question_number]) }}" 
                               class="btn question-button {{ $isAnswered ? 'btn-success' : 'btn-outline-secondary' }}">
                                {{ $question->question_number }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Submit Button -->
<div class="d-flex justify-content-end mt-3">
    <form method="GET" action="{{ url('/exam-summary/' . $quizId) }}">
        <button class="btn btn-primary btn-submit" id="submitExamButton">Submit and Finish Exam</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let timeLimit = @json($timeDuration) * 60;
    let startTime = localStorage.getItem('startTime');
    let timeRemaining = timeLimit;

    // Check if restarting
    if (localStorage.getItem('restartExam')) {
        startTime = Date.now();
        localStorage.setItem('startTime', startTime);
        timeRemaining = timeLimit;

        // Clear all selections and reset question statuses
        document.querySelectorAll('input[type="radio"]').forEach(input => input.checked = false);
        document.querySelectorAll('.question-button').forEach(button => button.classList.remove('solved'));

        // Reset counters
        localStorage.setItem('solvedCount', 0);
        localStorage.setItem('unsolvedCount', {{ $totalQuestions }});

        // Clear the restart flag
        localStorage.removeItem('restartExam');
    } else if (startTime) {
        // Calculate elapsed time if the exam has already started
        let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        timeRemaining = Math.max(timeLimit - elapsedTime, 0);
    } else {
        // Set initial start time
        startTime = Date.now();
        localStorage.setItem('startTime', startTime);
    }

    const timerElement = document.getElementById('timer');
    const interval = setInterval(function () {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (timeRemaining <= 0) {
            clearInterval(interval);

            // Disable all question buttons except the "Submit and Finish Exam" button
            document.querySelectorAll('.question-button').forEach(button => button.disabled = true);

            // Auto-submit the exam form when time is up
            document.getElementById("quizForm").submit();

            // Show the timer message after form submission
            timerElement.textContent = "Time's up!";
            
            // Redirect to exam summary page if necessary
            window.location.href = "{{ route('exam.summary', ['quiz_id' => $quiz->id]) }}";
        }

        timeRemaining--;
        localStorage.setItem('timeRemaining', timeRemaining);
    }, 1000);
});
</script>


</body>
</html>
