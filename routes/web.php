<?php

use App\Exports\ThesisTemplateExport;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AssessmentController,
    ChangePasswordController,
    HomeController,
    InfoUserController,
    RegisterController,
    ResetController,
    SemesterController,
    SessionsController,
    ThesisController,
    ThesisImportController,
    ThesisInvitationController,
    ThesisResultController,
    UserController
};

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // AUTH
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'create');
        Route::post('register', 'store');
    });

    Route::controller(SessionsController::class)->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('session', 'store')->name('session.store');
    });

    // RESET PASSWORD
    Route::controller(ResetController::class)->prefix('password')->group(function () {
        Route::get('forgot', 'create')->name('password.request');
        Route::post('forgot', 'sendEmail')->name('password.email');
        Route::get('reset/{token}', 'resetPass')->name('password.reset');
    });

    Route::post(
        'reset-password',
        [ChangePasswordController::class, 'changePassword']
    )->name('password.update');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/', [HomeController::class, 'home'])
        ->name('dashboard');

    // PROFILE
    Route::controller(InfoUserController::class)->group(function () {
        Route::get('user-profile', 'create');
        Route::post('user-profile', 'store');
    });

    // LOGOUT
    Route::get('logout', [SessionsController::class, 'destroy'])
        ->name('logout');

    // STATIC
    Route::view('static-sign-in', 'static-sign-in')
        ->name('sign-in');

    Route::view('static-sign-up', 'static-sign-up')
        ->name('sign-up');

    /*
    |--------------------------------------------------------------------------
    | THESIS
    |--------------------------------------------------------------------------
    */

    Route::resource('thesis', ThesisController::class);

    /*
    |--------------------------------------------------------------------------
    | ASSESSMENT
    |--------------------------------------------------------------------------
    */

    Route::prefix('assessment')
        ->name('assessment.')
        ->controller(AssessmentController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');

            Route::get('{thesisId}/form', 'form')
                ->name('form');

            Route::post('{thesis}/autosave', 'autoSave')
                ->name('autosave');

            Route::post('final/{thesisId}', 'submitFinal')
                ->name('submit-final');
        });

    Route::get('assessment/{id}', [ThesisResultController::class, 'show'])->name('assessment.show');
    /*
    |--------------------------------------------------------------------------
    | RESULTS
    |--------------------------------------------------------------------------
    */

    Route::prefix('results')->name('results.')->controller(ThesisResultController::class)->group(function () {

        Route::get('/', 'indexLecturer')
            ->name('lecturer');

        Route::get('{id}', 'show')
            ->name('show');
    });

    Route::post('/assessment/{thesisId}/finalization', [ThesisResultController::class, 'submitFinalization'])->name('assessment.finalization.submit');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

    Route::prefix('users/{type}')
        ->name('users.')
        ->controller(UserController::class)
        ->group(function () {

            Route::get('/', 'indexAdmin')->name('index');
            Route::get('create', 'create')->name('create');

            Route::post('store', 'store')->name('store');
            Route::post('import', 'import')->name('import');

            Route::get('export', 'export')->name('export');
            Route::get('download-template', 'downloadTemplate')
                ->name('download-template');

            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');

            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    /*
        |--------------------------------------------------------------------------
        | SEMESTER
        |--------------------------------------------------------------------------
        */

    Route::resource('semester', SemesterController::class);

    /*
        |--------------------------------------------------------------------------
        | THESIS MANAGEMENT
        |--------------------------------------------------------------------------
        */
    Route::resource('thesis', ThesisController::class);

    Route::prefix('thesis')->name('thesis.')->group(function () {

        Route::get(
            '{id}/assign',
            [ThesisController::class, 'assign']
        )->name('assign');

        Route::post(
            '{id}/assign-examiners',
            [ThesisController::class, 'assignExaminers']
        )->name('assign-examiners');

        Route::post(
            '{thesis}/send-email',
            [ThesisInvitationController::class, 'send']
        )->name('send-email');

        Route::post('/admin/thesis/import', [ThesisImportController::class, 'import'])
            ->name('import');

        Route::post('/thesis/import/preview', [ThesisImportController::class, 'preview'])
            ->name('import.preview');

        Route::post('/thesis/import/store', [ThesisImportController::class, 'store'])
            ->name('import.store');

        Route::get('/thesis/template', function () {
            return Excel::download(
                new ThesisTemplateExport,
                'template_thesis.xlsx'
            );
        })->name('download');
    });

    /*
        |--------------------------------------------------------------------------
        | RESULTS
        |--------------------------------------------------------------------------
        */

    Route::resource('results', ThesisResultController::class);

    Route::get('/assessment/{thesisId}/finalization', [ThesisResultController::class, 'finalization'])->name('assessment.finalization');
});
