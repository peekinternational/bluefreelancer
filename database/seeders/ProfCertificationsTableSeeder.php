<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfCertificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profcertifications')->truncate();
        $certs = [
            ['title' => 'CCNA'],
            ['title' => 'CCNP'],
            ['title' => 'CDP'],
            ['title' => 'CCIE'],
            ['title' => 'MCSA'],
            ['title' => 'CMDBA'],
            ['title' => 'PMP'],
            ['title' => 'CDPSE'],
            ['title' => 'CCSP'],
            ['title' => 'CEH'],
        ];
        DB::table('profcertifications')->insert($certs);
    }
}
