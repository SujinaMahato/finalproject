<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Test</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
         <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .top-bar {
            background-color: #007bff;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .card {
            margin: 10px;
            width: 22.5%;
            border: 1px solid #ddd; 
            border-radius: 10px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            transition: box-shadow 0.3s ease;
            background-color: white;
            overflow: hidden; 
        }

        .card:hover {
           box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
       }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .badge-available,
        .badge-available-buy {
            border: 1px solid;
            padding: 3px 5px;
            font-size: 12px;
            border-radius: 12px;
            display: inline-block;
            margin-right: 3px;
        }

        .badge-available {
            color: #008631;
            border-color: #008631;
        }

        .badge-available-buy {
            color: #008631;
            border-color: #008631;
        }

        .buy-btn {
            background-color: #008631;
            color: white;
            font-size: 14px;
            border-radius: 5px;
            padding: 5px;
            border: 2px solid #008631;
        }

        .btn-secondary{
            font-size: 12px;
            border-radius: 5px;
            padding: 5px;
            color: #00bfff;
            background-color: white;
            border-radius: 12px;
            border: 1px solid #00bfff;

        }

        .exam-list,
        .exam-packages {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .exam-header {
            text-align: center;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .exam-card-header {
            text-align: center;
            padding: 5px;
            background-color: #e9ecef;
        }

        .rounded-badge {
            background-color: #f0f0f0;
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 12px;
            display: inline-block;
        }

        .mt-4{
            color: #448EE4;
        }

        .active {
        background-color: skyblue; 
        color: white;
        }

       
       .profile-section {
            margin: 20px auto; 
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
            max-width: 500px;
            position: relative; 
        }

        .profile-section h3 {
            color: #007bff;
            text-align: center; 
        }

        .profile-section .form-group {
            margin-bottom: 15px;
        }

        .hover-menu {
            display: none; 
            position: absolute; 
            background-color: white; 
            border: 1px solid #ddd; 
            z-index: 1000; 
            right: 0; 
            width: 150px; 
        }

        .user-icon:hover .hover-menu {
            display: block; 
        }

        .hover-menu a {
            color: black; 
            padding: 10px;
            text-decoration: none;
            display: block; 
        }

        .hover-menu a:hover {
            background-color: #007bff; 
            color: white; 
        }

        .user-info {
            display: flex;
            flex-direction: column; 
            align-items: flex-start;
        }

        .user-info .user-name {
            display: flex; 
            align-items: center; 
        }

        .user-info .user-name span {
            margin-right: 8px;
        }

        .user-info .user-name .fas {
            font-size: 30px; 
        }

        .user-info span.role {
            margin-left: 0px; 
        }

      .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: #28a745; 
        color: white;
        padding: 20px;
        border-radius: 5px;
        width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .popup-content {
        text-align: center;
    }

    .popup-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); 
        z-index: 9998;
    }


    #close-popup {
        margin-top: 10px;
        background-color: white;
        color: #28a745;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    #close-popup:hover {
        background-color: #f8f9fa; 
    }
    .filled {
    color: #FFD700; 
    
}
.no-star {
    color: #afaea9; 
}

    
    </style>
</head>

<body>

<div class="sidebar">
    <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-list"></i> Exam List
    </a>
    
    <a href="{{ route('student.result') }}" class="{{ request()->routeIs('result') ? 'active' : '' }}">
        <i class="fas fa-poll"></i> Results
    </a>
    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
        <i class="fas fa-user"></i> Profile
    </a>
</div>


<div class="content">
    <div class="top-bar">
    <h3>Online Test</h3>
    <div class="user-icon">
        <div class="user-info">
            <div class="user-name">
                <span>{{ auth()->user()->username }}</span> <!-- Display the username -->
                
                @if(auth()->user()->image) <!-- Check if user has an uploaded image -->
                    <img src="{{ Storage::url(auth()->user()->image) }}" alt="User Image" class="user-profile-img" style="width: 30px; height: 30px; border-radius: 50%;">
                @else
                    <i class="fas fa-user-circle"></i> <!-- Default icon if no image -->
                @endif
            </div>
                <span class="role">Student</span> 
            </div>
            <div class="hover-menu">
                <a href="{{ route('profile') }}">Profile</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="nav-link" id="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>

<h2 class="mt-4"><strong>Available Exams</strong></h2>
<div class="exam-list">
    @foreach ($quizzes as $quiz)
        @if($quiz->price == 0 || $quiz->price == null) 
            <div class="card">
                <div class="exam-card-header">
                @if($quiz->photo)
                            <img src="/storage/{{ $quiz->photo }}" alt="{{ $quiz->heading }}" width="50" height="50" class="me-2">
                        @else
                            <img src="/images/exam_logo.png" alt="Exam Logo" width="50" height="50" class="me-2">
                        @endif

                    <h6 ><strong>{{ $quiz->heading }}</strong></h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $quiz->sub_heading }}</h5>
                    @foreach ($quiz->tags as $tag)
                        <span class="rounded-badge">{{ $tag->name }}</span>
                    @endforeach
                    <br><br>
                    <span class="badge-available">{{ $quiz->active ? 'Available' : 'Unavailable' }}</span> 
                    <div class="mt-3">
                        <span class="text-warning">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star {{ $i < $quiz->ratings->avg('rating') ? 'filled' : 'no-star' }}"></i> 
                            @endfor
                        </span>
                        <span class="ml-2">({{ $quiz->ratings->avg('rating') ?? 'No rating' }})</span>
                    </div>
                    @if($quiz->active)
                        <a href="{{ route('exam', ['examTitle' => $quiz->heading]) }}" class="btn btn-primary mt-2">
                            START EXAM
                        </a>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
</div>

<h2 class="mt-4"><strong>Exam Packages</strong></h2>
<div class="exam-packages">
    @if(isset($quizzes) && (is_array($quizzes) ? !empty($quizzes) : $quizzes->isNotEmpty()))
        @php
            $quizzesGroupedByPackage = $quizzes->groupBy('package_id');
        @endphp

        @foreach ($quizzesGroupedByPackage as $packageId => $quizzes)
            @if ($quizzes->first()->package)
                @php
                    $package = $quizzes->first()->package;
                    $activePayment = $payments->firstWhere(function ($payment) use ($quizzes) {
                        return $payment->amount == $quizzes->first()->price && $payment->is_active;
                    });
                @endphp

                <div class="card mb-4">
                    <div class="exam-card-header d-flex align-items-center p-3">
                        <img src="{{ $package->image ? asset($package->image) : '/images/package.png' }}" 
                             alt="{{ $package->name }}" width="50" height="50" class="me-2">
                        <h6><strong>{{ $package->name ?? 'No Package Available' }}</strong></h6>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $package->name ?? 'No Package Available' }}</h5>
                        <p class="quiz-count">{{ $quizzes->count() }} exams</p>
                        <span class="badge-available">{{ $quizzes->first()->active ? 'Available' : 'Unavailable' }}</span>

                        @if($quizzes->first()->active)
                            @if($activePayment) 
                                <a href="{{ route('available.exams') }}" class="btn btn-primary mt-2">VIEW</a>
                            @else 
                                @if($quizzes->first()->price)
                                    <button class="btn buy-btn mt-2" data-package-name="{{ $package->name }}" 
                                            data-price="{{ $quizzes->first()->price }}" data-toggle="modal" 
                                            data-target="#buyExamModal">BUY RS. {{ $quizzes->first()->price }}
                                    </button>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <p>No exam packages available.</p>
    @endif
</div>

<div class="modal fade" id="buyExamModal" tabindex="-1" aria-labelledby="buyExamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyExamModalLabel">Buy Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                    @csrf
                    <h5 id="modal-package-name"></h5> 
                    <p id="modal-price"></p> 

                    <input type="hidden" name="tAmt" id="totalAmount" value=""> 
                    <input type="hidden" name="amt" id="packagePriceInput" value=""> 
                    <input type="hidden" name="txAmt" value="0">  
                    <input type="hidden" name="psc" value="0">    
                    <input type="hidden" name="pdc" value="0">  

                    <input type="hidden" name="scd" value="EPAYTEST">
                    <input type="hidden" name="pid" id="productID" value="">
                    <input type="hidden" name="package_id" value="{{ $quizzes->first()->package_id }}">
 

                    <input type="hidden" name="su" value="{{ route('payment.success') }}"> 
                    <input type="hidden" name="fu" value="{{ route('payment.failure') }}"> 

                  
                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">

                    <button type="submit" class="btn btn-success">BUY WITH ESEWA</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var buyButtons = document.querySelectorAll('.buy-btn');
    
    buyButtons.forEach(function(button) {
        button.addEventListener('click', function () {
            var packageName = this.getAttribute('data-package-name');
            var price = this.getAttribute('data-price');

            document.getElementById('modal-package-name').textContent = packageName;
            document.getElementById('modal-price').textContent = 'Price: Rs. ' + price;

            document.getElementById('packagePriceInput').value = price;
            document.getElementById('totalAmount').value = price;

            document.getElementById('productID').value = 'PID_' + Date.now();
        });
    });
});
</script>


@if (session('success'))
    <div id="payment-popup" class="popup">
        <div class="popup-content">
            <p>{{ session('success') }}</p>
            <button id="close-popup">Close</button>
        </div>
    </div>
@elseif (session('error'))
    <div id="payment-popup" class="popup">
        <div class="popup-content">
            <p>{{ session('error') }}</p>
            <button id="close-popup">Close</button>
        </div>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
    var popup = document.getElementById('payment-popup');
    if (popup) {
        popup.style.display = 'block';
    }

    var closeButton = document.getElementById('close-popup');
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            popup.style.display = 'none';
        });
    }
});

</script>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>