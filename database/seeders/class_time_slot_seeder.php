<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class class_time_slot_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $day = Array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday");
        $timeSlot = Array("07:30 - 08:20","08:20 - 09:10","09:10 - 10:00","10:30 - 11:15","11:15 - 12:00");

        foreach($day as $everyDay)
        {
            foreach($timeSlot as $eachTime)
            {
                DB::table('class_time_slots')->insertGetId(
                    [
                        'Day' => $everyDay,
                        'start_end_time' => $eachTime
                    ]
                );
            }
        }
    }
}
