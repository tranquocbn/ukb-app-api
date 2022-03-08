<?php

use App\Http\Controllers\Student\LeaveController as StudentLeaveController;
use App\Http\Controllers\Student\ScoreController as StudentScoreController;
use App\Http\Controllers\UserController;
use App\Models\AcademicDepartment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use GuzzleHttp\Psr7\Request;

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
        $user = AcademicDepartment::find(1)->classes()->get();
        // $user = User::whereHasMorph('userable', [Department::class])->get();
        // $user = Department::first();
        dd($user);
    });

    Route::get('scores/{schedule_id}', [StudentScoreController::class, 'showScores']);

    Route::group(['prefix'=>'leave'],function(){
        Route::post('/subjects_current', [StudentLeaveController::class, 'getSubjectsInSemesterCurrent']);
        
        Route::post('/test', function() {
            return 'ok';
        });

        Route::post('/create', [StudentLeaveController::class, 'create']);
    });

    Route::group(['prefix'=>'attendance'],function() {
        Route::get('info-lesson', [StudentAttendanceController::class, 'getInfoLesson']);
        Route::get('attendance/{lesson_id}', [StudentAttendanceController::class, 'attendance']);
    });

});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function() {
    //route teacher
    Route::group(['prefix'=>'attendance'],function() {
        Route::get('get-info-lesson', [TeacherAttendanceController::class, 'getInfoLesson']);
        Route::get('check-state-lesson', [TeacherAttendanceController::class, 'checkStateLesson']);
        Route::post('turn-on-attendance/{lesson_id}', [TeacherAttendanceController::class, 'turnOnAttendance']);
        Route::get('turn-off-attendance/{lesson_id}', [TeacherAttendanceController::class, 'turnOffAttendance']);
    });
    
});

Route::middleware(['auth:sanctum', 'role:homeroom_teacher'])->group(function() {
    //route homeroom_teacher
});








