<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $dummy_data = [
            [
                'name' => 'Google Ads'
            ],
            [
                'name' => 'Python'
            ],
            [
                'name' => 'C Language'
            ],
            [
                'name' => 'DSA (DAta Structure & Algorithm)'
            ],
        ];

        foreach ($dummy_data as $data) {
            Course::create($data);
        }
    }
}
