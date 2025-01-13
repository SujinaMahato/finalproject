<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserResult;
use App\Models\User;
class TeacherDashboardController extends Controller
{
    public function dashboard()
    {
        $totalQuestions = Question::count(); 

        $passCount = UserResult::where('percentage', '>=', 50)->count(); 
        $failCount = UserResult::where('percentage', '<', 50)->count();
        $totalUsers = User::count();        
        $totalQuizzes = Quiz::count();
        return view('teacher.dashboard.list', compact('totalQuestions', 'passCount', 'failCount', 'totalUsers', 'totalQuizzes'));
    }
}
