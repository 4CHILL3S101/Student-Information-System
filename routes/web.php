<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentGradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::resource('subject-component', SubjectController::class);
    Route::resource('student-component', StudentController::class);
    Route::resource('enroll-component', EnrollmentController::class);
    Route::resource('grades-component', GradeController::class);
    Route::resource('dashboard-component', DashboardController::class);
});

Route::prefix('student')->group(function () {
    Route::resource('student-grades-component', StudentGradeController::class);
    Route::resource('student-dashboard-component', StudentDashboard::class);
});


Route::get('/', function () {return view('welcome');});
Route::get('/admin-dashboard', function () { return view('admin_dashboard');})->middleware(['auth', 'verified'])->name('admin-dashboard');
Route::get('/student-dashboard', function () { return view('student_dashboard');})->middleware(['auth', 'verified'])->name('student-dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
