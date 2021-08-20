<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->truncate();
        $skills = [
            ['title' => 'HTML'],
            ['title' => 'CSS'],
            ['title' => 'Javascript'],
            ['title' => 'Java'],
            ['title' => 'PHP'],
            ['title' => 'MySQL'],
            ['title' => 'SQL'],
            ['title' => 'C#'],
            ['title' => 'JavaScript'],
            ['title' => 'C++'],
            ['title' => 'Python'],
            ['title' => 'iOS/Swift'],
            ['title' => 'Ruby on Rails'],
            ['title' => 'SEO'],
            ['title' => 'SMO'],
            ['title' => 'SMM'],
            ['title' => 'PPC'],
            ['title' => 'UX Design'],
            ['title' => 'AdWords'],
            ['title' => 'Email Marketing'],
            ['title' => 'SEMRush'],
            ['title' => 'Majestic'],
            ['title' => 'SEO Power Suite'],
            ['title' => 'SEM'],
            ['title' => 'Laravel'],
        ];
        DB::table('skills')->insert($skills);
    }
}
