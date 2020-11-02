<?php

namespace Database\Seeders;

use App\Models\Week;
use Illuminate\Database\Seeder;

class weekTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Week::Create([
            'week_day' => 'شنبه',
        ]);

        Week::Create([
            'week_day' => 'یکشنبه',
        ]);

        Week::Create([
            'week_day' => 'دوشنبه',
        ]);

        Week::Create([
            'week_day' => 'سه‌شنبه',
        ]);

        Week::Create([
            'week_day' => 'جهار‌شنبه',
        ]);

        Week::Create([
            'week_day' => 'پنج‌شنبه',
        ]);
        Week::Create([
            'week_day' => 'جمعه',
        ]);
    }
}
