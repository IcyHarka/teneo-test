<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsenceTypeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $absenceTypes = [
            ['type' => 'sick', 'value' => 'Bolovanje', 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'vacation', 'value' => 'Godišnji odmor', 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'personal', 'value' => 'Personalno odsustvo', 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($absenceTypes as $absenceType) {
            if (!DB::table('absence_types')->where('type', $absenceType['type'])->exists()) {
                DB::table('absence_types')->insert($absenceType);
            }
        }
    }
}
