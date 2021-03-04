<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Staff\RecruitmentController;
use App\Http\Controllers\staffHubController;
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

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login.showForm');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::get('/recruitments/success', [RecruitmentController::class, 'showSuccess'])->name('recruitments.showSuccess');
Route::get('/recruitments/{recruitment}', [RecruitmentController::class, 'show'])->name('recruitments.show');
Route::post('recruitments/{recruitment}/applications', [ApplicationController::class, 'store'])->name('recruitments.applications.store');

Route::middleware(['auth', 'temporary_password'])->group(function() {
    Route::get('/staff/temporary-password/edit', [UserController::class, 'editTemporaryPassword'])->name('staff.temporary-password.edit');
    Route::post('/staff/temporary-password/update', [UserController::class, 'updateTemporaryPassword'])->name('staff.temporary-password.update');
});

Route::middleware(['auth', 'not_temporary_password'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [StaffHubController::class, 'showHub'])->name('hub');
        Route::get('/news-management', [StaffHubController::class, 'showHub'])->name('news-management');
        Route::get('/convoy-management', [StaffHubController::class, 'showHub'])->name('convoy-management');
        Route::get('/partnership-management', [StaffHubController::class, 'showHub'])->name('partnership-management');
        Route::get('/gallery-management', [StaffHubController::class, 'showHub'])->name('gallery-management');

        Route::get('/contact-messages', [StaffHubController::class, 'showHub'])->name('contact-messages');
        Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::post('/contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');
        Route::post('/contact-messages/{contactMessage}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])->name('contact-messages.mark-as-unread');
        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        Route::get('/role-permission-management', [StaffHubController::class, 'showHub'])->name('role-permission-management');

        Route::get('/recruitment-management', [RecruitmentController::class, 'index'])->name('recruitment-management');
        Route::get('/recruitments/create', [RecruitmentController::class, 'create'])->name('recruitments.create');
        Route::post('/recruitments/store', [RecruitmentController::class, 'store'])->name('recruitments.store');
        Route::get('/recruitments/{recruitment}/edit', [RecruitmentController::class, 'edit'])->name('recruitments.edit');
        Route::patch('/recruitments/{recruitment}', [RecruitmentController::class, 'update'])->name('recruitments.update');
        Route::delete('/recruitments/{recruitment}', [RecruitmentController::class, 'destroy'])->name('recruitments.destroy');

        Route::post('/recruitments/{recruitment}/questions/store', [QuestionController::class, 'store'])->name('recruitments.questions.store');
        Route::patch('/recruitments/{recruitment}/questions/{question}', [QuestionController::class, 'update'])->name('recruitments.questions.update');
        Route::delete('/recruitments/{recruitment}/questions/{question}', [QuestionController::class, 'destroy'])->name('recruitments.questions.destroy');

        Route::get('/recruitments/{recruitment}/applications', [ApplicationController::class, 'index'])->name('recruitments.applications.index');
        Route::get('/recruitments/{recruitment}/applications/{application}', [ApplicationController::class, 'show'])->name('recruitments.applications.show');

        Route::post('/recruitments/{recruitment}/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('recruitments.applications.accept');
        Route::post('/recruitments/{recruitment}/applications/{application}/decline', [ApplicationController::class, 'decline'])->name('recruitments.applications.decline');

        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');

        Route::get('/staff-members-management', [UserController::class, 'index'])->name('staff-members-management');
    });
});

Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact-messages.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact-messages.store');
Route::get('/contact/success', [ContactMessageController::class, 'showSuccess'])->name('contact-messages.show-success');
