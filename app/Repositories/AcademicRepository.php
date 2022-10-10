<?php
namespace App\Repositories;

use App\Models\Academic;
class AcademicRepository extends BaseRepository {

    public function model()
    {
        return Academic::class;
    }

    /**
     * get year start of academic function
     *
     * @param int $classId
     * @return mixed
     */
    public function getYearStart(int $classId)
    {
        return $this->model
        ->whereHas('classes', function($e) use ($classId) {
            $e->where('classes.id', $classId);
        })
        ->get()
        ->pluck('year_start')
        ->toArray();
    }
}