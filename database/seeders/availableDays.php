<?php

namespace Database\Seeders;

use App\Models\AvalableDays;
use Illuminate\Database\Seeder;

class availableDays extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AvalableDays::Create([
            'doctor_id' => 1,
        'week_day_id' => 1,
        'start_time' => "2020-11-01 17:13",
        'end_time' => "2020-11-01 8:00:00",
        ]);
    }
}
