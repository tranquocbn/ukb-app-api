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
     * getInfoLesson function
     * @param $scheduleId, $date
     * @return mixed
     */
    public function getInfoLesson($scheduleId)
    {
        return $this->model
            ->where('schedule_id', $scheduleId)
            ->where('state', '<>', 1)
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
     * check state attendance lesson
     * @param $scheduleId, $dateLearn
     * @return mixed
     */
    public function checkStateLesson($lessonId)
    {
        return $this->model
                    ->where('id', $lessonId)
                    ->get()
                    ->pluck('state');
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
}
