<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminCertificateController;
use App\Http\Controllers\AdminEvaluationController;
use App\Http\Controllers\AdminInterviewController;
use App\Http\Controllers\AdminJournalController;
use App\Http\Controllers\AdminPositionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminApplicantController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\AdminInternController;
use App\Http\Controllers\StudentApplicationController;


Route::get('/', [LowonganController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::post('/student/applications', [StudentApplicationController::class, 'store'])
        ->name('student.applications.store');

    Route::get('/student/applications', [StudentController::class, 'applications'])->name('student.applications');


    Route::get('/student/journal', [JournalController::class, 'index'])->name('student.journal');
    Route::post('/student/journal', [JournalController::class, 'store'])->name('student.journal.store');
    Route::delete('/student/journal/{id}', [JournalController::class, 'destroy'])->name('student.journal.destroy');


    Route::get('/student/evaluation', [EvaluationController::class, 'index'])->name('student.evaluation');


    Route::post('final-report', [EvaluationController::class, 'storeFinalReport'])->name('finalreport.store');
    Route::post('/student/final-report', [StudentController::class, 'report'])->name('student.finalreport.store');

    Route::get('/studentprofile', [StudentProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [StudentProfileController::class, 'changePassword'])->name('profile.changePassword');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    Route::get('/positions', [AdminPositionController::class, 'index'])->name('admin.positions');
    Route::post('/positions', [AdminPositionController::class, 'store'])->name('positions.store');
    Route::put('/positions/{position}', [AdminPositionController::class, 'update'])->name('positions.update');
    Route::delete('/positions/{position}', [AdminPositionController::class, 'destroy'])->name('positions.destroy');


    Route::get('/applicants', [AdminApplicantController::class, 'index'])->name('admin.applicants');
    Route::get('/applicants/{id}', [AdminApplicantController::class, 'show'])->name('applicants.show');
    Route::post('/applicants/{id}/score', [AdminApplicantController::class, 'updateScore'])->name('applicants.score');
    Route::put('/applicants/{id}', [AdminApplicantController::class, 'update'])->name('admin.applicants.update');
    Route::delete('/applicants/{id}', [AdminApplicantController::class, 'destroy'])->name('admin.applicants.destroy');

    Route::get('/interviews', [AdminInterviewController::class, 'index'])->name('admin.interviews');
    Route::post('/interviews', [AdminInterviewController::class, 'store'])->name('admin.interviews.store');
    Route::put('/interviews/{id}', [AdminInterviewController::class, 'update'])->name('admin.interviews.update');
    Route::delete('/interviews/{id}', [AdminInterviewController::class, 'destroy'])->name('admin.interviews.destroy');


    Route::get('/admin/intern', [AdminInternController::class, 'index'])->name('admin.intern');
    Route::put('/admin/intern/{id}', [AdminInternController::class, 'update'])->name('admin.intern.update');
    Route::delete('/admin/intern/{id}', [AdminInternController::class, 'destroy'])->name('admin.intern.destroy');

    // ✅ Tambahan:
    Route::get('/intern/{id}/journals', [AdminJournalController::class, 'show'])->name('admin.intern.journals');
    Route::post('/intern/{id}/evaluation', [AdminInternController::class, 'storeEvaluation'])->name('admin.intern.evaluation.store');
    Route::post('/intern/{id}/certificate', [AdminInternController::class, 'storeCertificate'])->name('admin.intern.certificate.store');

    // Journal & Evaluation pages
    Route::get('/admin/intern/{user}/journal', [AdminJournalController::class, 'show'])->name('admin.journals.show');
    Route::get('/admin/intern/{user}/evaluation', [AdminEvaluationController::class, 'show'])->name('admin.evaluations.show');

    // Certificate management
    Route::post('/admin/certificate', [AdminCertificateController::class, 'store'])->name('admin.certificate.store');
    Route::put('/admin/certificate/{certificate}', [AdminCertificateController::class, 'update'])->name('admin.certificate.update');
    Route::delete('/admin/certificate/{certificate}', [AdminCertificateController::class, 'destroy'])->name('admin.certificate.destroy');


    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.user');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');



});
