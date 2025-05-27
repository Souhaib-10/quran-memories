<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemorizeController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route auth super admin
Route::middleware(['auth', 'role:superAdmin'])->group(function () {
    Route::resource('admins', AdminController::class);
});
Route::get("/", [StudentController::class, "index"])->name('students.index');
//Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('students')->group(function () {

        //Route student class
        //Route::get("/", [StudentController::class, "index"])->name('students.index');
        Route::get("/create", [StudentController::class, "create"])->name("students.create");
        Route::post("/", [StudentController::class, "store"])->name("students.store");
        Route::delete("/{student}", [StudentController::class, "destroy"])->name("students.destroy");
        Route::get("/{student}", [StudentController::class, "show"])->name("students.show");
        Route::get("/{student}/edit", [StudentController::class, "edit"])->name("students.edit");
        Route::put("/{student}", [StudentController::class, "update"])->name("students.update");
    });

    Route::prefix('memorizes')->group(function () {

        // Route Memorize class
        Route::get("/create", [MemorizeController::class, "create"])->name('memorizes.create');
        Route::post("/", [MemorizeController::class, "store"])->name('memorizes.store');
        Route::delete("/{memorize}", [MemorizeController::class, 'destroy'])->name('memorizes.destroy');
        Route::get("/{memorize}/edit", [MemorizeController::class, 'edit'])->name('memorizes.edit');
        Route::put("/{memorize}", [MemorizeController::class, 'update'])->name("memorizes.update");
    });
//});
// auth controller
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.quran');
Route::post('/login/quran', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout/quran', [AuthController::class, 'logout'])->name('logout.quran')->middleware('auth');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::resource('admins', AdminController::class);
// });
