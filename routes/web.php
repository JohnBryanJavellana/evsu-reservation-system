<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Logout;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\ForgotPasswordController;

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminEquipment;
use App\Http\Controllers\Admin\AdminCalendar;
use App\Http\Controllers\Admin\AdminRoom;
use App\Http\Controllers\Admin\AdminPatron;
use App\Http\Controllers\Admin\AdminAccountHistory;
use App\Http\Controllers\Admin\AdminReservation;
use App\Http\Controllers\Admin\AdminPersonalAccount;

use App\Http\Controllers\Patron\PatronDashboard;
use App\Http\Controllers\Patron\PatronCalendar;
use App\Http\Controllers\Patron\PatronReservation;
use App\Http\Controllers\Patron\PatronAccountHistory;
use App\Http\Controllers\Patron\PatronPersonalAccount;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['GET', 'POST'], '/', [Login::class, 'login'])->name('login');
Route::match(['GET', 'POST'], '/register', [Register::class, 'register']);

Route::get('/forgot-password', function () { return view('forgot-password'); })->middleware(['guest'])->name('password.request');
Route::get('/reset-password/{token}', function (string $token) { return view('reset-password', ['token' => $token]); })->middleware(['guest'])->name('password.reset');
Route::post('/forgot-password-func', [ForgotPasswordController::class, 'forgotPassword'])->middleware(['guest'])->name('password.email');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware(['guest'])->name('password.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/welcome/logout', [Logout::class, 'logout_user']);

    # admin only routes
    Route::middleware(['adminprevilege'])->prefix('/welcome/administrator/')->group(function () {
        # dashboard
        Route::get('dashboard', [AdminDashboard::class, 'dashboard']);

        # reservation
        Route::get('reservations', [ AdminReservation::class, 'reservationList' ]);
        Route::get('reservations/info/{reservation}', [ AdminReservation::class, 'infoReservation' ]);
        Route::get('reservations/info/{reservation}/updateStatus/{value}', [ AdminReservation::class, 'infoReservationUpdateStatus' ]);

        # calendar
        Route::get('calendar', [ AdminCalendar::class, 'calendar' ]);

        # rooms
        Route::get('room/list', [ AdminRoom::class, 'roomList' ]);
        Route::match(['GET', 'POST'], 'room/new', [ AdminRoom::class, 'newRoom' ]);
        Route::match(['GET', 'POST'], 'room/list/info.{room_id}', [ AdminRoom::class, 'infoRoom' ]);
        Route::get('room/list/info.{room_id}/removePhoto.{photo_id}', [ AdminRoom::class, 'infoRoomRemovePhoto' ]);
        Route::get('room/list/remove.{room_id}', [ AdminRoom::class, 'removeRoom' ]);

        # equipment
        Route::get('equipment/list', [ AdminEquipment::class, 'equipmentList' ]);
        Route::match(['GET', 'POST'], 'equipment/new', [ AdminEquipment::class, 'newEquipment' ]);
        Route::match(['GET', 'POST'], 'equipment/list/info.{equipment_id}', [ AdminEquipment::class, 'infoEquipment' ]);
        Route::get('equipment/list/remove.{equipment_id}', [ AdminEquipment::class, 'removeEquipment' ]);

        # patrons
        Route::get('patron/list', [ AdminPatron::class, 'patronList' ]);
        Route::match(['GET', 'POST'], 'patron/new', [ AdminPatron::class, 'newPatron' ]);
        Route::match(['GET', 'POST'], 'patron/list/update.{patron_id}', [ AdminPatron::class, 'editPatron' ]);
        Route::get('patron/list/remove.{patron_id}', [ AdminPatron::class, 'removePatron' ]);

        # account history
        Route::get('account-history', [ AdminAccountHistory::class, 'log' ]);

        # personal account
        Route::match(['GET', 'POST'], 'my-account', [ AdminPersonalAccount::class, 'personal_account' ]);
    });

    Route::middleware(['patronprevilege'])->prefix('/welcome/patron/')->group(function () {
        # dashboard
        Route::get('dashboard', [PatronDashboard::class, 'dashboard']);

        # reservation
        Route::get('reservation/list', [ PatronReservation::class, 'reservationList' ]);
        Route::match(['GET', 'POST'], 'reservation/new', [ PatronReservation::class, 'newReservation' ]);
        Route::match(['GET', 'POST'], 'reservation/new/rent/{room}/{from?}&{to?}', [ PatronReservation::class, 'newReservationRent' ]);
        Route::get('reservation/list/info/{reservation}', [ PatronReservation::class, 'infoReservation' ]);
        Route::get('reservation/list/info/{reservation}/updateStatus/{value}', [ PatronReservation::class, 'infoReservationUpdateStatus' ]);

        # calendar
        Route::get('calendar', [ PatronCalendar::class, 'calendar' ]);

        # account history
        Route::get('account-history', [ PatronAccountHistory::class, 'log' ]);

        # personal account
        Route::match(['GET', 'POST'], 'my-account', [ PatronPersonalAccount::class, 'personal_account' ]);
    });
});