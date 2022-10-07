<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LessonSeeder extends Seeder
{

    public function insert(array $data)     
    {       
        $lessons = $data['credit'] == 3 ? 11: 8;
        for($i=0; $i <= $lessons; $i++) {
            $s = $i * 7;
            $date = date_create($data['date']);
            date_add($date, date_interval_create_from_date_string("$s days"));
            $dateLearn = date_format($date, 'Ymd');
            DB::table('lessons')
            ->insert([
                'schedule_id' => $data['schedule_id'],
                'date_learn'  => $dateLearn,
                'state'       => 0
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'credit' => 2,
                'schedule_id'   => 1,
                'date'  => '2019-06-22'
            ],
            [
                'credit' => 3,
                'schedule_id'   => 2,
                'date'  => '2018-06-20'
            ],
            [
                'credit' => 2,
                'schedule_id' => 3,
                'date' => '2022-8-19'
            ]
        ];   
        foreach($data as $value) {
            $this->insert($value);
        }     
        return;
    }
}
