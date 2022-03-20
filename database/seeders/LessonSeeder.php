<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')
        ->insert([
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-06-29',
                'content'     => 'Khái niệm tư tương hcm',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'assessment'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ],
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-07-06',
                'content'     => 'chương 1',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'assessment'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ],
            [
                'schedule_id' => 1,
                'date_learn'  => '2019-07-14',
                'content'     => 'chương 2',
                'radius'      => 30,
                'latitude'    => '1232.2424.234',
                'longitude'   => '3252.324.334',
                'assessment'    => 0,
                'comment'     => 'Sôi nổi',
                'state'       => 3
            ]

        ]);
    }
}
