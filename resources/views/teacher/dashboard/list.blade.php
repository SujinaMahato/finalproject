@extends('teacher.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5>Total Questions</h5>
                        <h3>{{ $totalQuestions }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h5>Passed Users</h5>
                        <h3>{{ $passCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h5>Failed Users</h5>
                        <h3>{{ $failCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        <h5>Total Users</h5>
                        <h3>{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <h5>Total Quizzes</h5>
                        <h3>{{ $totalQuizzes }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Exam Statistics - Bar Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="examBarChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Exam Statistics - Pie Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="examPieChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxBar = document.getElementById('examBarChart').getContext('2d');
        const examBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Total Questions', 'Passed Users', 'Failed Users', 'Total Users', 'Total Quizzes'],
                datasets: [{
                    label: 'Exam Statistics',
                    data: [{{ $totalQuestions }}, {{ $passCount }}, {{ $failCount }},
                        {{ $totalUsers }}, {{ $totalQuizzes }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxPie = document.getElementById('examPieChart').getContext('2d');
        const examPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Total Questions', 'Passed Users', 'Failed Users', 'Total Users', 'Total Quizzes'],
                datasets: [{
                    data: [{{ $totalQuestions }}, {{ $passCount }}, {{ $failCount }},
                        {{ $totalUsers }}, {{ $totalQuizzes }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
