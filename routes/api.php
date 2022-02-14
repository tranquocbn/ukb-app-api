<?php

use App\Http\Controllers\UserController;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\DB;

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
    Route::get('getInfoLesson', [AttendanceController::class, 'getInfoLesson']);

});

Route::middleware(['auth:sanctum', 'role:homeroom_teacher'])->group(function() {
    //route homeroom_teacher
});

Route::get('test', function(){
    $id = DB::table('schedules')
                ->join('users', 'schedules.user_id', 'users.id')
                ->join('leaves', 'leaves.schedule_id', 'schedules.id')
                ->select('schedules.id')
                ->where('users.code', 'gv01')
                ->where('schedules.session', 1)
                ->whereRaw("DATEDIFF('2022-02-12', schedules.date_start)%7 = ?",[0])
                ->whereNotIn('2022-02-12', DB::table('leaves')
                                            ->where('leaves.schedule_id', 'schedules.id')
                                            ->where('leaves.date_want', '2022-02-12')
                                            ->get()
                                            ->toArray()
                            )
                ->orWhere(function($query) {
                            $query->whereNotIn('2022-02-12',
                                            DB::table('leaves')
                                        ->select('leaves.date_want')
                                        ->where('leaves.schedule_id', 'schedules.id')
                                        ->get()
                                        ->toArray()
                                        )
                                ->where('leaves.date_change', '2022-02-12');
                            })
                ->limit(1)
                ->get();
    return $id;
});