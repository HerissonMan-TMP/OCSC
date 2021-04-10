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

//Public: Homepage.
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

//Public: Articles.
Route::resource('articles', ArticleController::class)->only([
    'index', 'show'
]);

//Public: Convoy & Convoy rules.
Route::get('upcoming-convoys', [ConvoyController::class, 'showUpcoming'])->name('convoys.show-upcoming');
Route::view('convoy-rules', 'convoy-rules')->name('convoy-rules');

//Public: Pictures (Gallery).
Route::get('gallery', [PictureController::class, 'gallery'])->name('gallery');

//Public: Recruitments & Global requirements.
Route::get('recruitments/{recruitment}', [RecruitmentController::class, 'show'])->name('recruitments.show');
Route::post('recruitments/{recruitment}/applications', [ApplicationController::class, 'store'])
    ->name('recruitments.applications.store');
Route::view('applications/success', 'applications.success-page')->name('applications.success-page');
Route::view('global-requirements', 'global-requirements')->name('global-requirements');

//Public: Contact messages.
Route::view('contact/success', 'contact-messages.success-page')->name('contact-messages.success-page');
Route::get('contact', [ContactMessageController::class, 'create'])->name('contact-messages.create');
Route::post('contact', [ContactMessageController::class, 'store'])->name('contact-messages.store');

//Public: Legal notice & Privacy policy.
Route::view('legal-notice', 'legal-notice')->name('legal-notice');
Route::view('privacy-policy', 'privacy-policy')->name('privacy-policy');

//Public (without Staff): Login.
Route::middleware(['guest'])->group(function () {
    Route::view('login', 'login')->name('login.show-form');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

//Staff: Temporary password.
Route::middleware(['auth', 'temporary-password'])->group(function() {
    Route::view('staff/temporary-password/edit', 'edit-temporary-password')
        ->name('staff.temporary-password.edit');
    Route::post('staff/temporary-password/update', [UserController::class, 'updateTemporaryPassword'])
        ->name('staff.temporary-password.update');
});

//Staff without a password.
Route::middleware(['auth', 'not-temporary-password'])->prefix('staff')->name('staff.')->group(function () {
    //Hub.
    Route::view('/', 'hub')->name('hub');

    //Articles.
    Route::get('articles/manage', [ArticleController::class, 'manage'])->name('articles.manage');
    Route::resource('articles', ArticleController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);

    //Partnership.
    Route::view('partnership-management', '')->name('partnership-management');

    //Convoys & Convoy rules.
    Route::resource('convoys', ConvoyController::class)->except([
        'show'
    ]);
    Route::patch('convoy-rules', [ConvoyRulesController::class, 'update'])->name('convoy-rules.update');

    //Pictures (Gallery).
    Route::delete('pictures/delete-many', [PictureController::class, 'destroyMany'])
        ->name('pictures.destroy-many');
    Route::resource('pictures', PictureController::class)->except([
        'show'
    ]);

    //Roles & Permissions.
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::patch('roles/{role}/update-colors', [RoleController::class, 'updateColors'])
        ->name('roles.update-colors');
    Route::patch('roles/{role}/permissions', [PermissionController::class, 'update'])
        ->name('roles.permissions.update');

    //Recruitments (+ Questions & Applications) & Requirements.
    Route::resource('recruitments', RecruitmentController::class)->except(
        'show'
    );
    Route::resource('recruitments.questions', QuestionController::class)->only(
        'store', 'update', 'destroy'
    )->shallow();
    Route::post('applications/{application}/accept', [ApplicationController::class, 'accept'])
        ->name('applications.accept');
    Route::post('applications/{application}/decline', [ApplicationController::class, 'decline'])
        ->name('applications.decline');
    Route::resource('recruitments.applications', ApplicationController::class)->only(
        'index', 'show'
    )->shallow();
    Route::patch('global-requirements', [GlobalRequirementsController::class, 'update'])
        ->name('global-requirements.update');

    //Contact messages.
    Route::post('contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])
        ->name('contact-messages.mark-as-read');
    Route::post('contact-messages/{contactMessage}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])
        ->name('contact-messages.mark-as-unread');
    Route::resource('contact-messages', ContactMessageController::class)->only([
        'index', 'show', 'destroy'
    ]);

    //Users.
    Route::patch('users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');
    Route::resource('users', UserController::class)->except(
        'edit', 'update'
    );

    //Downloads.
    Route::resource('downloads', DownloadController::class)->except(
        'show', 'create', 'edit'
    );

    //Website Settings (+ Legal notice and Privacy policy).
    Route::view('website-settings', 'website-settings.show')->name('website-settings');
    Route::patch('legal-notice', [LegalNoticeController::class, 'update'])->name('legal-notice.update');
    Route::patch('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');

    //Maintenance mode.
    Route::post('maintenance-mode/enable', [MaintenanceModeController::class, 'enable'])
        ->name('maintenance-mode.enable');
    Route::post('maintenance-mode/disable', [MaintenanceModeController::class, 'disable'])
        ->name('maintenance-mode.disable');

    //Logout.
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
