<?php

use App\Http\Controllers\UserController;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:student'])->group(function() {
    Route::get('user', function() {
        echo 'La SV';
        $user = User::whereHasMorph('userable', [Department::class])->get();
        // $user = Department::first();
        dd($user);
    });
});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function() {
    //route teacher
});

Route::middleware(['auth:sanctum', 'role:homeroom_teacher'])->group(function() {
    //route homeroom_teacher
});