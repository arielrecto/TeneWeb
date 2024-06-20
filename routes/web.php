<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;
use App\Http\Controllers\Admin\UnverifiedTenantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreRegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\RoomController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\TenementController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Tenant\AnnouncementController as TenantAnnouncementController;
use App\Http\Controllers\Tenant\AnnouncementFeedController;
use App\Http\Controllers\Tenant\BillController as TenantBillController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use App\Models\AnnouncementFeed;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pre-register')->as('pre.register.')->group(function(){
    Route::get('', [PreRegisterController::class, 'create'])->name('create');
    Route::get('/tenement/{tenement}/rooms', [PreRegisterController::class, 'getRooms']);
    Route::post('', [PreRegisterController::class, 'store'])->name('store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'home']);

    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        Route::resource('tenants', AdminTenantController::class);
        Route::resource('rooms', AdminRoomController::class);
        Route::resource('unverified-tenant', UnverifiedTenantController::class)->except(['create']);
        Route::resource('bills', BillController::class);
        Route::resource('announcements', AnnouncementController::class);
    });

    Route::middleware(['role:super-admin'])->prefix('super-admin')->as('super-admin.')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('users')->as('users.')->group(function(){
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::resource('admins', AdminController::class);
            Route::resource('tenants', TenantController::class);
        });
        Route::resource('rooms', RoomController::class);
        Route::resource('tenements', TenementController::class);
    });

    Route::middleware(['role:tenant'])->prefix('tenant')->as('tenant.')->group(function(){
        Route::get('/dashboard', [TenantDashboardController::class, 'dashboard'])->name('dashboard');


        Route::prefix('bills')->as('bills.')->group(function(){
            Route::get('', [TenantBillController::class, 'index'])->name('index');
            Route::get('{bill}', [TenantBillController::class, 'show'])->name('show');
        });

        Route::prefix('announcements')->as('announcements.')->group(function(){
            Route::get('', [TenantAnnouncementController::class, 'index'])->name('index');
            Route::get('{announcement}', [TenantAnnouncementController::class, 'show'])->name('show');
        });
        Route::resource('announcement-feeds', AnnouncementFeedController::class);
    });

});




require __DIR__.'/auth.php';
