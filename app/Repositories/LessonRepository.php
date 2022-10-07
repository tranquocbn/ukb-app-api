<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Lesson;

class LessonRepository extends BaseRepository
{
    public function model()
    {
        return Lesson::class;
    }

    /**
     * get date_learn function
     *
     * @param $scheduleId
     * @return mixed
     */
    public function getDateLearn($scheduleId)
    {
        return $this->model
        ->select('date_learn')
        ->where('schedule_id', $scheduleId)
        ->whereDate('date_learn', '>=', date('Y-m-d'))
        ->get();
    }
    /**
     * teacher, student check Schedule 
     * @param $field, $id, $date, $session
     * @return mixed
     */
    public function checkSchedule($field, $id, $date, $session)
    {
        // return $this->model
        //     ->where('date_learn', $date)
        //     ->whereHas('schedule', function($e) use ($field, $id, $session){
        //         $e-> where($field, $id)
        //         ->where('session', $session);
        //     }) 
        //     ->get();
        return $this->model
            ->where('date_learn', '2019-06-22')
            ->whereHas('schedule', function($e) use ($field, $id, $session){
                $e-> where($field, $id)
                ->where('session', 1);
            }) 
            ->get();
    }

    /**
     * countLessonCurrent function
     *
     * @param $scheduleId, $date
     * @return mixed
     */
    public function countLessonCurrent($scheduleId, $date)
    {
        // return $this->model
        //     ->where('schedule_id', $scheduleId)
        //     ->where('date_learn', '<=', $date)
        //     ->count();

        return $this->model
            ->where('schedule_id', $scheduleId)
            ->where('date_learn', '<=', '2019-07-13')
            ->count();
    }

    /**
     * getInfoLesson function
     * @param $lessonId
     * @return mixed
     */
    public function getInfoLesson($lessonId)
    {
        return $this->model
            ->where('id', $lessonId)
            ->with(['schedule' => function($query) {
                $query->select('id', 'user_id', 'class_id', 'subject_id', 'room_id')
                    ->with('teacher:id,name')
                    ->with(['class' => function($e) {
                        $e -> select('id', 'name')
                            ->withCount(['students' => function($e) {
                                $e -> where('role_id', 2);
                            }]);
                    }])
                    ->with('subject:id,name')
                    ->with('room:id,name');
            }])
            ->get();
    }

    /**
     * teacherTurnOnAttendance function
     * @param array $data
     * @return mixed
     */
    public function teacherTurnOnAttendance(array $data)
    {
        return $this->model
                    ->where('id', $data['lessonId'])
                    ->update(
                        [
                            'radius'   => $data['radius'],
                            'latitude' => $data['latitude'],
                            'longitude' => $data['longitude'],
                            'state'    => 2
                        ]
                    );
    }

    /**
     * teacherTurnOffAttendance function
     * @param $lessonId
     * @return mixed
     */
    public function teacherTurnOffAttendance($lessonId)
    {
        return $this->model
                    ->where('id', $lessonId)
                    ->update(['state'=> 3]);
    }

    public function yearLearn(array $data)
    {
        return $this->model
        ->whereHas('schedule', function($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        })
        ->get();
    }
}
