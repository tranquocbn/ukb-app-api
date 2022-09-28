<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Student\LeaveController as StudentLeaveController;
use App\Http\Controllers\Student\ScoreController as StudentScoreController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\SubjectController as StudentSubjectController;
use App\Http\Controllers\Student\ScheduleController as StudentScheduleController;
use App\Http\Controllers\Student\LessonController as StudentLessonController;

use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\ScoreController as TeacherScoreController;
use App\Http\Controllers\Teacher\SubjectController as TeacherSubjectController;
use App\Http\Controllers\Teacher\ClassController as TeacherClassController;
use App\Http\Controllers\Teacher\LeaveController as TeacherLeaveController;
use App\Http\Controllers\Teacher\ScheduleController as TeacherScheduleController;







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


Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::group(['prefix' => 'account'], function(){
        Route::get('info', [UserController::class, 'info']); 
        Route::put('update', [UserController::class, 'update']); 
    });
});

Route::middleware(['auth:sanctum', 'role:student'])->group(function() {

    Route::get('scores/{schedule_id}', [StudentScoreController::class, 'showScores']);

    Route::group(['prefix' => 'leave'],function(){
        Route::get('subjects-schedule', [StudentSubjectController::class, 'getSubjectsSchedule']); //thừa
        Route::get('leaves-semester/{schedule_id}', [StudentLeaveController::class, 'leavesSemester']);
        Route::get('subjects-semester/{schedule_id}');

        Route::post('subjects-current', [StudentSubjectController::class, 'getSubjectsInSemesterCurrent']);
        Route::post('check-date', [StudentLeaveController::class, 'checkDate']);
        Route::post('create', [StudentLeaveController::class, 'studentStore']);
    });

    Route::group(['prefix' => 'notify'], function() {
        
    });

    Route::group(['prefix'=>'attendance'],function() {
        Route::get('info-lesson', [StudentLessonController::class, 'getInfoLesson']);
        Route::post('attendance', [StudentAttendanceController::class, 'attendance']);
    });

    Route::group(['prefix' => 'score'], function() {
        Route::get('get-semesters', [StudentScheduleController::class, 'getSemesters']);
        Route::get('get-scores/{schedule_id}', [StudentScoreController::class, 'getScore']);
        Route::post('s-feedback-score', [StudentScoreController::class, 'feedbackScore']);
    });
});


Route::middleware(['auth:sanctum', 'role:teacher'])->group(function() {
    Route::group(['prefix' => 'lesson'], function() {
        Route::get('/', [TeacherScheduleController::class, 'yearLearn']);
    });

    Route::group(['prefix'=>'attendance'],function() {
        Route::get('get-info-lesson', [TeacherLessonController::class, 'getInfoLesson']);
        Route::post('turn-on-attendance/{lesson_id}', [TeacherAttendanceController::class, 'turnOnAttendance']);
        Route::get('turn-off-attendance/{lesson_id}/{state}', [TeacherAttendanceController::class, 'turnOffAttendance']);
    });
    
    Route::group(['prefix' => 'score'], function() {
        Route::get('get-subjects', [TeacherSubjectController::class, 'getSubjects']);
        Route::get('get-classes/{schedule_id}', [TeacherClassController::class, 'getClasses']);
        Route::get('get-scores/{schedule_id}/{class_id}', [TeacherScoreController::class, 'getScores']);
        Route::get('get-score/{schedule_id}/{student_id}', [TeacherScoreController::class, 'getScoreByStudentId']);
        Route::post('update-score', [TeacherScoreController::class, 'updateScore']);
        Route::post('t-feedback-score', [TeacherScoreController::class, 'feedbackScore']);
    });
});

Route::middleware(['auth:sanctum', 'role:homeroom_teacher'])->group(function() {
    //route homeroom_teacher
});
