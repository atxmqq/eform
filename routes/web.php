<?php

use App\Http\Controllers\Admin\FormTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkflowController;
use App\Http\Controllers\Approver\ApprovalController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\SubmissionController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', fn() => redirect()->route('login'));
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['th', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// Auth
Route::get('/login', fn() => view('auth.login'))->name('login')->middleware('guest');
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('auth.social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('auth.social.callback');
Route::post('/login/dev', [SocialAuthController::class, 'loginDev'])->name('login.dev')->middleware('guest');
Route::post('/logout', [SocialAuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated
Route::middleware(['auth'])->group(function () {
    // Profile & Signature (ไม่บังคับ signature เพื่อป้องกัน redirect loop)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/signature', [ProfileController::class, 'updateSignature'])->name('profile.signature');

    // ทุก route ด้านล่างบังคับให้มีลายเซ็นก่อน
    Route::middleware(['require.signature'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PDF Download (accessible by student owner, approvers, and admin)
    Route::get('/submissions/{submission}/pdf', [PdfController::class, 'download'])->name('submissions.pdf');

    // Admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('form-types', FormTypeController::class)->except(['show']);
        Route::post('form-types/{formType}/fields', [FormTypeController::class, 'storeField'])->name('form-types.fields.store');
        Route::delete('form-types/{formType}/fields/{field}', [FormTypeController::class, 'destroyField'])->name('form-types.fields.destroy');
        Route::post('form-types/{formType}/workflow', [WorkflowController::class, 'store'])->name('workflow.store');
        Route::delete('form-types/{formType}/workflow/{step}', [WorkflowController::class, 'destroy'])->name('workflow.destroy');
        Route::post('form-types/{formType}/workflow/reorder', [WorkflowController::class, 'reorder'])->name('workflow.reorder');
        Route::resource('users', UserController::class)->only(['index', 'update']);
    });

    // Student
    Route::prefix('submissions')->name('student.submissions.')->middleware('role:student')->group(function () {
        Route::get('/', [SubmissionController::class, 'index'])->name('index');
        Route::get('/advisors/search', [SubmissionController::class, 'searchAdvisors'])->name('advisors.search');
        Route::get('/new/{formType}', [SubmissionController::class, 'create'])->name('create');
        Route::post('/new/{formType}', [SubmissionController::class, 'store'])->name('store');
        Route::get('/{submission}', [SubmissionController::class, 'show'])->name('show');
    });

    // Approver
    Route::prefix('approvals')->name('approver.')->middleware('role:advisor,program_chair,faculty_dean,graduate_officer,grad_vice_dean,grad_dean')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('index');
        Route::get('/{submission}', [ApprovalController::class, 'show'])->name('show');
        Route::post('/{submission}', [ApprovalController::class, 'act'])->name('act');
    });
    }); // end require.signature
});
