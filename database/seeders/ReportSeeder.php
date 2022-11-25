<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_states')->insert(
            [
                [
                    'id' => 1,
                    'state' => 'por analisar',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'state' => 'em análise',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'state' => 'finalizado',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
