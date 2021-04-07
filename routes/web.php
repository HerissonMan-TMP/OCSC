<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ConvoyController;
use App\Http\Controllers\ConvoyRulesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\GlobalRequirementsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaintenanceModeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('test');
});

Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'login')->name('login.showForm');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/upcoming-convoys', [ConvoyController::class, 'showUpcoming'])->name('convoys.show-upcoming');
Route::view('/convoy-rules', 'convoy-rules')->name('convoy-rules');
Route::get('gallery', [PictureController::class, 'gallery'])->name('gallery');

Route::get('/recruitments/{recruitment}', [RecruitmentController::class, 'show'])->name('recruitments.show');
Route::post('recruitments/{recruitment}/applications', [ApplicationController::class, 'store'])->name('recruitments.applications.store');
Route::view('/global-requirements', 'global-requirements')->name('global-requirements');
Route::view('/applications/success', 'applications.success-page')->name('applications.success-page');

Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact-messages.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact-messages.store');
Route::view('/contact/success', 'contact-messages.success-page')->name('contact-messages.show-success');

Route::view('/legal-notice', 'legal-notice')->name('legal-notice');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');

Route::middleware(['auth', 'temporary_password'])->group(function() {
    Route::view('/staff/temporary-password/edit', 'edit-temporary-password')->name('staff.temporary-password.edit');
    Route::post('/staff/temporary-password/update', [UserController::class, 'updateTemporaryPassword'])->name('staff.temporary-password.update');
});

Route::middleware(['auth', 'not_temporary_password'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('staff')->name('staff.')->group(function () {
        Route::view('/', 'hub')->name('hub');

        Route::get('articles/manage', [ArticleController::class, 'manage'])->name('articles.manage');
        Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::patch('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

        Route::delete('pictures/delete-many', [PictureController::class, 'destroyMany'])->name('pictures.destroy-many');
        Route::resource('pictures', PictureController::class)->except(['show']);

        Route::get('/convoys', [ConvoyController::class, 'index'])->name('convoys.index');
        Route::get('/convoys/create', [ConvoyController::class, 'create'])->name('convoys.create');
        Route::post('/convoys/store', [ConvoyController::class, 'store'])->name('convoys.store');
        Route::get('/convoys/{convoy}/edit', [ConvoyController::class, 'edit'])->name('convoys.edit');
        Route::patch('/convoys/{convoy}', [ConvoyController::class, 'update'])->name('convoys.update');
        Route::delete('/convoys/{convoy}', [ConvoyController::class, 'destroy'])->name('convoys.destroy');
        Route::patch('/convoy-rules', [ConvoyRulesController::class, 'update'])->name('convoy-rules.update');

        Route::view('/partnership-management', '')->name('partnership-management');

        Route::view('/website-settings', 'website-settings.show')->name('website-settings');
        Route::patch('/legal-notice', [LegalNoticeController::class, 'update'])->name('legal-notice.update');
        Route::patch('/privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');
        Route::post('/maintenance-mode/enable', [MaintenanceModeController::class, 'enable'])->name('maintenance-mode.enable');
        Route::post('/maintenance-mode/disable', [MaintenanceModeController::class, 'disable'])->name('maintenance-mode.disable');

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::post('/contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');
        Route::post('/contact-messages/{contactMessage}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])->name('contact-messages.mark-as-unread');
        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        Route::get('/role-permission-management', [RoleController::class, 'index'])->name('role-permission-management');
        Route::patch('/roles/{role}/permissions', [PermissionController::class, 'update'])->name('roles.permissions.update');

        Route::get('recruitments', [RecruitmentController::class, 'index'])->name('recruitments.index');
        Route::get('/recruitments/create', [RecruitmentController::class, 'create'])->name('recruitments.create');
        Route::post('/recruitments/store', [RecruitmentController::class, 'store'])->name('recruitments.store');
        Route::get('/recruitments/{recruitment}/edit', [RecruitmentController::class, 'edit'])->name('recruitments.edit');
        Route::patch('/recruitments/{recruitment}', [RecruitmentController::class, 'update'])->name('recruitments.update');
        Route::delete('/recruitments/{recruitment}', [RecruitmentController::class, 'destroy'])->name('recruitments.destroy');

        Route::post('/recruitments/{recruitment}/questions', [QuestionController::class, 'store'])->name('recruitments.questions.store');
        Route::patch('/recruitments/{recruitment}/questions/{question}', [QuestionController::class, 'update'])->name('recruitments.questions.update');
        Route::delete('/recruitments/{recruitment}/questions/{question}', [QuestionController::class, 'destroy'])->name('recruitments.questions.destroy');

        Route::get('/recruitments/{recruitment}/applications', [ApplicationController::class, 'index'])->name('recruitments.applications.index');
        Route::get('/recruitments/{recruitment}/applications/{application}', [ApplicationController::class, 'show'])->name('recruitments.applications.show');

        Route::post('/recruitments/{recruitment}/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('recruitments.applications.accept');
        Route::post('/recruitments/{recruitment}/applications/{application}/decline', [ApplicationController::class, 'decline'])->name('recruitments.applications.decline');

        Route::patch('/global-requirements', [GlobalRequirementsController::class, 'update'])->name('global-requirements.update');

        Route::get('/staff-members-list', [UserController::class, 'index'])->name('staff-members-list');

        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');

        Route::resource('downloads', DownloadController::class)->except('show', 'create', 'edit');
    });
});
