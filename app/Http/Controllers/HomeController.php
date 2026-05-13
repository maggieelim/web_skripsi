<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use App\Services\SemesterService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $totalLecturers = User::role('lecturer')->count();
        $totalAdmins = User::role('admin')->count();
        $totalStudents = User::role('student')->count();
        $activeSemester = SemesterService::active();
        $semesterStart = Carbon::parse($activeSemester->start_date)->format('d M Y');
        $semesterEnd = Carbon::parse($activeSemester->end_date)->format('d M Y');

        $lecturerId = Lecturer::where('user_id', $user->id)->value('id');

        return view('dashboard', compact(
            'totalAdmins',
            'totalLecturers',
            'totalStudents',
            'activeSemester',
            'semesterStart',
            'semesterEnd',
        ));
    }
}
