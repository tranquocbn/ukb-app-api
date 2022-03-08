<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\LeaveController as StudentLeaveController;
use App\Http\Controllers\Student\ScoreController as StudentScoreController;

use App\Http\Controllers\Student\SubjectController as StudentSubjectController;

use App\Http\Controllers\Teacher\ScheduleController as TeacherScheduleController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;




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

    Route::get('scores/{schedule_id}', [StudentScoreController::class, 'showScores']);

    Route::group(['prefix'=>'leave'],function(){
        Route::get('subjects-schedule', [StudentSubjectController::class, 'getSubjectsSchedule']);
        Route::get('leaves-semester/{schedule_id}', [StudentLeaveController::class, 'leavesSemester']);
        Route::get('subjects-semester/{schedule_id}');

        Route::post('subjects-current', [StudentSubjectController::class, 'getSubjectsInSemesterCurrent']);
        Route::post('check-date', [StudentLeaveController::class, 'checkDate']);
        Route::post('create', [StudentLeaveController::class, 'studentStore']);
    });

});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function() {
    //route teacher
    Route::group(['prefix'=>'attendance'],function() {
        Route::get('get-info-lesson', [TeacherScheduleController::class, 'getInfoLesson']);
        Route::get('check-state-lesson', [TeacherLessonController::class, 'checkStateLesson']);
        Route::post('turn-on-attendance', [TeacherLessonController::class, 'turnOnAttendance']);
        Route::get('turn-off-attendance', [TeacherLessonController::class, 'turnOffAttendance']);
    });
    
});

Route::middleware(['auth:sanctum', 'role:homeroom_teacher'])->group(function() {
    //route homeroom_teacher
});





