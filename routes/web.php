<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\VideoAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\AcademicSessionController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\TeacherController;




/*
|--------------------------------------------------------------------------
| Public Routes (No Auth Required)
|--------------------------------------------------------------------------
*/

Route::view('/', 'landing')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/admissions', 'admissions')->name('admissions');
Route::view('/programs', 'programs')->name('programs');
Route::view('/contact', 'contact')->name('contact');
Route::view('/portal', 'portal')->name('portal');
Route::view('/staff', 'staff')->name('staff');

// Dynamic Content Pages
Route::get('/channel', [ChannelController::class, 'index'])->name('channel.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

/*
|--------------------------------------------------------------------------
| Role-Based Portal Login Routes (Guest Only)
|--------------------------------------------------------------------------
*/

Route::prefix('portal')->middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('portal.admin.login');

    Route::get('/teacher/login', [AuthenticatedSessionController::class, 'create'])
        ->name('portal.teacher.login');

    Route::get('/student/login', [AuthenticatedSessionController::class, 'create'])
        ->name('portal.student.login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (admin + super-admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin|super-admin', 'share.session'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('blog', BlogAdminController::class)
            ->except('show')
            ->names([
                'index' => 'blog.index',
                'create' => 'blog.create',
                'store' => 'blog.store',
                'edit' => 'blog.edit',
                'update' => 'blog.update',
                'destroy' => 'blog.destroy',
            ]);

        Route::resource('videos', VideoAdminController::class)
            ->except('show')
            ->names([
                'index' => 'videos.index',
                'create' => 'videos.create',
                'store' => 'videos.store',
                'edit' => 'videos.edit',
                'update' => 'videos.update',
                'destroy' => 'videos.destroy',
            ]);

        Route::resource('gallery', GalleryAdminController::class)
            ->except('show')
            ->names([
                'index' => 'gallery.index',
                'create' => 'gallery.create',
                'store' => 'gallery.store',
                'edit' => 'gallery.edit',
                'update' => 'gallery.update',
                'destroy' => 'gallery.destroy',
            ]);

        Route::resource('events', EventAdminController::class)
            ->except('show')
            ->names([
                'index' => 'events.index',
                'create' => 'events.create',
                'store' => 'events.store',
                'edit' => 'events.edit',
                'update' => 'events.update',
                'destroy' => 'events.destroy',
            ]);

        Route::resource('classes', SchoolClassController::class)
            ->names([
                'index' => 'classes.index',
                'create' => 'classes.create',
                'store' => 'classes.store',
                'edit' => 'classes.edit',
                'update' => 'classes.update',
                'destroy' => 'classes.destroy',
            ]);

        Route::resource('students', StudentController::class)
            ->names([
                'index' => 'students.index',
                'create' => 'students.create',
                'store' => 'students.store',
                'edit' => 'students.edit',
                'update' => 'students.update',
                'destroy' => 'students.destroy',
            ]);

        Route::resource('teachers', TeacherController::class);

        // Academic Sessions Management
        Route::get('/sessions', [AcademicSessionController::class, 'index'])
            ->name('sessions.index');

        Route::post('/sessions', [AcademicSessionController::class, 'store'])
            ->name('sessions.store');

        Route::post('/sessions/preferred', [AcademicSessionController::class, 'setPreferred'])
            ->name('sessions.preferred');

        Route::post('/sessions/{session}/make-current', [AcademicSessionController::class, 'setGlobalCurrent'])
            ->name('sessions.make-current');
        
        // Student Promotion
        Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
        Route::post('/promotions', [PromotionController::class, 'promote'])->name('promotions.promote');
        Route::post('/students/bulk-action', [StudentController::class, 'bulkAction'])->name('students.bulk-action');

        // Fees Management
        Route::resource('fees', FeeController::class);
        Route::get('/students/{student}/pay-fees', [FeeController::class, 'recordPayment'])->name('fees.pay');
        Route::post('/students/{student}/pay-fees', [FeeController::class, 'recordPayment']);
    });

/*
|--------------------------------------------------------------------------
| Teacher Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('teacher.dashboard'))->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Student Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('student.dashboard'))->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Register, Password Reset, etc.)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';