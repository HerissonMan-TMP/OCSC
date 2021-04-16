<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ConvoyController;
use App\Http\Controllers\ConvoyRulesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HubController;
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
use App\Http\Controllers\SubscriberController;
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

Route::middleware(['throttle:web', 'cors'])->group(function () {
    //Public: Homepage.
    Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

    //Public: Articles.
    Route::get('news', [ArticleController::class, 'news'])->name('news');
    Route::resource('articles', ArticleController::class)->only([
        'show'
    ]);

    //Public: Convoy & Convoy rules.
    Route::get('upcoming-convoys', [ConvoyController::class, 'showUpcoming'])->name('convoys.show-upcoming');
    Route::get('convoy-rules', [ConvoyRulesController::class, 'show'])->name('convoy-rules.show');

    //Public: Pictures (Gallery).
    Route::get('gallery', [PictureController::class, 'gallery'])->name('gallery');

    //Public: Recruitments & Global requirements.
    Route::get('recruitments/{recruitment}', [RecruitmentController::class, 'show'])->name('recruitments.show');
    Route::post('recruitments/{recruitment}/applications', [ApplicationController::class, 'store'])
        ->name('recruitments.applications.store');
    Route::view('applications/success', 'applications.success-page')->name('applications.success-page');
    Route::get('global-requirements', [GlobalRequirementsController::class, 'show'])->name('global-requirements.show');

    //Public: Contact messages.
    Route::view('contact/success', 'contact-messages.success-page')->name('contact-messages.success-page');
    Route::get('contact', [ContactMessageController::class, 'create'])->name('contact-messages.create');
    Route::post('contact', [ContactMessageController::class, 'store'])->name('contact-messages.store');

    //Public: Legal notice & Privacy policy.
    Route::get('legal-notice', [LegalNoticeController::class, 'show'])->name('legal-notice.show');
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy.show');

    Route::post('subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
    Route::get('unsubscribe/{subscriber:unsubscribe_token}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

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

    //Staff without a temporary password.
    Route::middleware(['auth', 'not-temporary-password'])->prefix('staff')->name('staff.')->group(function () {
        //Hub.
        Route::get('/', [HubController::class, 'show'])->name('hub');

        //Articles.
        Route::resource('articles', ArticleController::class)->except([
            'show',
        ]);

        //Partnership.
        Route::view('partnership-management', '')->name('partnership-management');

        //Convoys & Convoy rules.
        Route::resource('convoys', ConvoyController::class)->except([
            'show'
        ]);
        Route::get('convoy-rules/create', [ConvoyRulesController::class, 'create'])
            ->name('convoy-rules.create');
        Route::post('convoy-rules', [ConvoyRulesController::class, 'store'])
            ->name('convoy-rules.store');

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
        Route::get('global-requirements', [GlobalRequirementsController::class, 'create'])
            ->name('global-requirements.create');
        Route::post('global-requirements', [GlobalRequirementsController::class, 'store'])
            ->name('global-requirements.store');

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
            'show'
        );

        //Website Settings
        Route::prefix('website-settings')->name('website-settings.')->group(function () {
            //Legal Notice.
            Route::get('legal-notice/create', [LegalNoticeController::class, 'create'])->name('legal-notice.create');
            Route::post('legal-notice', [LegalNoticeController::class, 'store'])->name('legal-notice.store');

            //Privacy policy.
            Route::get('privacy-policy/create', [PrivacyPolicyController::class, 'create'])->name('privacy-policy.create');
            Route::post('privacy-policy', [PrivacyPolicyController::class, 'store'])->name('privacy-policy.store');

            //Statistics.
            Route::view('statistics', 'website-settings.statistics')->name('statistics');

            //Maintenance mode.
            Route::view('maintenance-mode', 'website-settings.maintenance-mode')->name('maintenance-mode');
            Route::post('maintenance-mode/enable', [MaintenanceModeController::class, 'enable'])
                ->name('maintenance-mode.enable');
            Route::post('maintenance-mode/disable', [MaintenanceModeController::class, 'disable'])
                ->name('maintenance-mode.disable');
        });

        //Profile settings.
        Route::view('profile-settings', 'profile-settings')->name('profile-settings');

        //Logout.
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
