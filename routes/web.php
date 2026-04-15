<?php

use App\Http\Controllers\PublicPart\Auth\AuthController;
use App\Http\Controllers\PublicPart\HomeController as PublicHomeController;
use App\Http\Controllers\System\Hotel\HotelController;
use App\Http\Controllers\System\Hotel\RoomsController;
use App\Http\Controllers\System\Settings\FAQsController;
use App\Http\Controllers\System\Settings\KeywordsController;
use App\Http\Controllers\System\Dashboard\DashboardController as SystemDashboardController;
use App\Http\Controllers\System\HomeController;
use App\Http\Controllers\System\Settings\SettingsController;
use App\Http\Controllers\System\Users\TwoFAController;
use App\Http\Controllers\System\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    /**
     *  Public part of Web App
     */
    Route::get ('/',                              [PublicHomeController::class, 'home'])->name('public.home');
});

/**
 *  Authentication routes; Used to authenticate user and all login / logout problems solving :
 *
 *      - authenticate
 *      - logout
 *      - create new account
 *      - verify account
 *      - restart password
 *      - generate new password
 */
Route::prefix('auth')->group(function () {
    Route::get ('/',                              [AuthController::class, 'auth'])->name('auth');
    Route::post('/authenticate',                  [AuthController::class, 'authenticate'])->name('auth.authenticate');
    // When 2FA is enabled
    Route::get ('/two-fa',                        [AuthController::class, 'twoFA'])->name('auth.two-fa');
    Route::post('/verify-two-fa',                 [AuthController::class, 'verifyTwoFA'])->name('auth.two-fa.verify');
    Route::get ('/logout',                        [AuthController::class, 'logout'])->name('auth.logout');

    /* Create an account */
    Route::get ('/create-account',                [AuthController::class, 'createAccount'])->name('auth.create-account');
    Route::post('/save-account',                  [AuthController::class, 'saveAccount'])->name('auth.save-account');
    Route::get ('/verify-account/{token}',        [AuthController::class, 'verifyAccount'])->name('auth.verify-account');

    /* Restart password */
    Route::get ('/account-recovery',              [AuthController::class, 'recoveryAccount'])->name('auth.account-recovery');
    Route::get ('/account-recovery-success',      [AuthController::class, 'recoveryAccountSuccess'])->name('auth.account-recovery-success');
    Route::post('/generate-restart-token',        [AuthController::class, 'generateRestartToken'])->name('auth.generate-restart-token');
    Route::get ('/new-password/{token}',          [AuthController::class, 'newPassword'])->name('auth.new-password');
    Route::post('/generate-new-password',         [AuthController::class, 'generateNewPassword'])->name('auth.generate-new-password');
});


/** ----------------------------------------------------------------------------------------------------------------- */
/**
 *  Admin routes
 */

Route::prefix('system')->middleware('isAuthenticated')->group(function () {
    /** Dashboard routes */
    Route::prefix('dashboard')->group(function (){
        Route::get('/',                            [SystemDashboardController::class, 'home'])->name('system.dashboard');
    });

    /** Users routes; */
    Route::prefix('users')->group(function () {
        Route::get ('/',                          [UsersController::class, 'index'])->name('system.users');
        Route::get ('/create',                    [UsersController::class, 'create'])->name('system.users.create');
        Route::post('/save',                      [UsersController::class, 'save'])->name('system.users.save');
        Route::get ('/preview/{username}',        [UsersController::class, 'preview'])->name('system.users.preview');
        Route::get ('/edit/{username}',           [UsersController::class, 'edit'])->name('system.users.edit');
        Route::post('/update',                    [UsersController::class, 'update'])->name('system.users.update');
        Route::post('/update-profile-image',      [UsersController::class, 'updateProfileImage'])->name('system.users.update-profile-image');

        /** My profile */
        Route::prefix('my-profile')->middleware('isAuthenticated')->group(function () {
            /** 2FA */
            Route::prefix('two-fa')->group(function () {
                Route::get ('/',                        [TwoFAController::class, 'home'])->name('system.users.my-profile.two-fa');
                Route::get ('/setup',                   [TwoFAController::class, 'setup'])->name('system.users.my-profile.two-fa.setup');
                Route::post('/activate',                [TwoFAController::class, 'activate'])->name('system.users.my-profile.two-fa.activate');
                Route::post('/deactivate',              [TwoFAController::class, 'deactivate'])->name('system.users.my-profile.two-fa.deactivate');
            });
        });
    });

    /** Hotel management */
    Route::prefix('hotel')->group(function (){
        Route::get('/',                            [HotelController::class, 'dashboard'])->name('system.hotel.dashboard');

        // Rooms
        Route::prefix('rooms')->group(function (){
            Route::get('/',                            [RoomsController::class, 'dashboard'])->name('system.hotel.rooms.dashboard');
            Route::get('/preview/{id}',                [RoomsController::class, 'preview'])->name('system.hotel.rooms.preview');
        });
    });

    /**
     *  1. Keywords
     *  2. FAQs
     */
    Route::prefix('settings')->middleware('isAdmin')->group(function (){
        Route::get ('/',                                        [SettingsController::class, 'home'])->name('system.settings');

        /** Keywords module */
        Route::prefix('keywords')->group(function () {
            Route::get ('/',                                    [KeywordsController::class, 'index'])->name('system.settings.keywords');
            Route::get ('/preview-instances/{key}',             [KeywordsController::class, 'previewInstances'])->name('system.settings.keywords.preview-instances');
            Route::get ('/new-instance/{key}',                  [KeywordsController::class, 'newInstance'])->name('system.settings.keywords.new-instance');

            Route::post('/save-instance',                       [KeywordsController::class, 'saveInstance'])->name('system.settings.keywords.save-instance');
            Route::get ('/edit-instance/{id}',                  [KeywordsController::class, 'editInstance'])->name('system.settings.keywords.edit-instance');
            Route::post('/update-instance',                     [KeywordsController::class, 'updateInstance'])->name('system.settings.keywords.update-instance');
            Route::get ('/delete-instance/{id}',                [KeywordsController::class, 'deleteInstance'])->name('system.settings.keywords.delete-instance');
        });

        /** FAQs module */
        Route::prefix('faq')->middleware('isAuthenticated')->group(function () {
            Route::get ('/',                               [FAQsController::class, 'index'])->name('system.settings.faq');
            Route::get ('/create',                         [FAQsController::class, 'create'])->name('system.settings.faq.create');
            Route::post('/save',                           [FAQsController::class, 'save'])->name('system.settings.faq.save');
            Route::get ('/edit/{id}',                      [FAQsController::class, 'edit'])->name('system.settings.faq.edit');
            Route::post('/update',                         [FAQsController::class, 'update'])->name('system.settings.faq.update');
            Route::get ('/delete/{id}',                    [FAQsController::class, 'delete'])->name('system.settings.faq.delete');
        });
    });
    /**
     *  Root Admin routes
     */
    Route::prefix('admin')->middleware('isAdmin')->group(function (){
        Route::get('/dashboard',                 [HomeController::class, 'index'])->name('system.admin.home');



        /**
         *  Other section
         *  1. FAQs
         */
        Route::prefix('other')->group(function () {
            /**
             *  FAQs section
             */

        });

        /**
         *  Core section:
         *  1. Keywords
         */
        Route::prefix('core')->group(function () {
            /**
             *  FAQs section
             */

        });
    });
});
