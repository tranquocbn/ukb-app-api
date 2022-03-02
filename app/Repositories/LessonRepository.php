<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository extends BaseRepository
{
    public function model()
    {
        return Lesson::class;
    }

    /**
     * check state attendance lesson
     * @param $scheduleId, $dateLearn
     * @return mixed
     */
    public function checkStateLesson($lessonId)
    {
        return $this->model
                    ->select('state')
                    ->where('id', $lessonId)
                    ->get();
    }
    
    /**
     * turn on attendance lesson
     * @param array $data
     * @return mixed
     */
    public function turnOnAttendance(array $data)
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
     * turn off attendance lesson
     * @param $lessonId
     * @return mixed
     */
    public function turnOffAttendance($lessonId)
    {
        return $this->model
                    ->where('id', $lessonId)
                    ->update(['state'=> 3]);
    }

    public function countStudent($lessonId)
    {
        return $this->model
            ->withCount('attendances as students_count')
            ->where('id', $lessonId)
            ->get()
            ->pluck('students_count');
    }

}
