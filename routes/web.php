<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ConvoyController;
use App\Http\Controllers\ConvoyRulesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\PartnerCategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnershipConditionsController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\GlobalRequirementsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaintenanceModeController;
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

Route::middleware(['throttle:web', 'cors'])->group(function () {
    //Public: Homepage.
    Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

    Route::view('services', 'services')->name('services');

    //Public: Articles.
    Route::get('news', [ArticleController::class, 'news'])->name('news');
    Route::resource('articles', ArticleController::class)->only([
        'show'
    ]);

    Route::get('supporters', [PartnerController::class, 'partners'])->name('partners');

    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');

    //Public: Convoy & Convoy rules.
    Route::get('convoys', [ConvoyController::class, 'convoys'])->name('convoys');
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
    Route::view('contact/success', 'contact-messages.success-page')
        ->name('contact-messages.success-page');
    Route::get('contact', [ContactMessageController::class, 'create'])
        ->name('contact-messages.create');
    Route::post('contact', [ContactMessageController::class, 'store'])
        ->name('contact-messages.store');

    //Public: Legal notice & Privacy policy.
    Route::get('legal-notice', [LegalNoticeController::class, 'show'])->name('legal-notice.show');
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy.show');

    //Public (without Staff): Login.
    Route::middleware(['guest'])->group(function () {
        Route::view('login', 'login')
            ->name('login.show-form');
        Route::post('login', [LoginController::class, 'authenticate'])
            ->name('login.authenticate');
    });

    //Staff: Temporary password.
    Route::middleware(['auth', 'temporary-password'])->group(function () {
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

        //supporters.
        Route::get('supporters', [PartnerController::class, 'index'])->name('partners.index');
        Route::get('supporters/create', [PartnerController::class, 'create'])->name('partners.create');
        Route::post('supporters/store', [PartnerController::class, 'store'])->name('partners.store');
        Route::get('supporters/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
        Route::patch('supporters/{partner}/update', [PartnerController::class, 'update'])->name('partners.update');
        Route::delete('supporters/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');


        Route::get('supporters-conditions/create', [PartnershipConditionsController::class, 'create'])
            ->name('partnership-conditions.create');
        Route::post('supporters-conditions', [PartnershipConditionsController::class, 'store'])
            ->name('partnership-conditions.store');
        Route::get('supporters-categories', [PartnerCategoryController::class, 'index'])
            ->name('partner-categories.index');
        Route::post('supporters-categories', [PartnerCategoryController::class, 'store'])
            ->name('partner-categories.store');
        Route::get('supporters-categories/{partnerCategory}/edit', [PartnerCategoryController::class, 'edit'])
            ->name('partner-categories.edit');
        Route::patch('supporters-categories/{partnerCategory}', [PartnerCategoryController::class, 'update'])
            ->name('partner-categories.update');
        Route::delete('supporters-categories/{partnerCategory}', [PartnerCategoryController::class, 'destroy'])
            ->name('partner-categories.destroy');

        //Convoys & Convoy rules.
        Route::delete('convoys/past', [ConvoyController::class, 'destroyPast'])->name('convoys.destroy-past');
        Route::delete('convoys/{convoy:truckersmp_event_id}', [ConvoyController::class, 'destroy'])->name('convoys.destroy');
        Route::resource('convoys', ConvoyController::class)->only([
            'index', 'create', 'store'
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
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::patch('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])
            ->name('roles.permissions.edit');
        Route::patch('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
            ->name('roles.permissions.update');

        //Recruitments (+ Questions & Applications) & Requirements.
        Route::resource('recruitments', RecruitmentController::class)->except(
            'show'
        );
        Route::resource('recruitments.questions', QuestionController::class)->only(
            ['store','update', 'destroy']
        )->shallow();
        Route::post('applications/{application}/accept', [ApplicationController::class, 'accept'])
            ->name('applications.accept');
        Route::post('applications/{application}/decline', [ApplicationController::class, 'decline'])
            ->name('applications.decline');
        Route::resource('recruitments.applications', ApplicationController::class)->only(
            ['index', 'show']
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
        Route::resource('users', UserController::class)->except(
            ['edit', 'update']
        );
        Route::patch('users/{user}/name', [UserController::class, 'updateName'])->name('users.name.update');
        Route::patch('users/{user}/email', [UserController::class, 'updateEmail'])->name('users.email.update');
        Route::patch('users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
        Route::post('users/{user}/reset-temporary-password', [UserController::class, 'resetTemporaryPassword'])
            ->name('users.temporary-password.reset');
        Route::patch('users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');

        //Downloads.
        Route::resource('downloads', DownloadController::class)->except(
            'show'
        );
        Route::get('downloads/{download}/download', [DownloadController::class, 'download'])->name('downloads.download');

        //Guides.
        Route::resource('guides', GuideController::class);

        //Website Settings
        Route::prefix('website-settings')->name('website-settings.')->group(function () {
            //Activity.
            Route::get('activity', [ActivityController::class, 'index'])->name('activity');

            //Legal Notice.
            Route::get('legal-notice/create', [LegalNoticeController::class, 'create'])->name('legal-notice.create');
            Route::post('legal-notice', [LegalNoticeController::class, 'store'])->name('legal-notice.store');

            //Privacy policy.
            Route::get('privacy-policy/create', [PrivacyPolicyController::class, 'create'])->name('privacy-policy.create');
            Route::post('privacy-policy', [PrivacyPolicyController::class, 'store'])->name('privacy-policy.store');

            //Statistics.
            Route::view('statistics', 'website-settings.statistics')->name('statistics');

            //Error logs.
            Route::get('error-logs', [ErrorController::class, 'index'])->name('error-logs');

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
