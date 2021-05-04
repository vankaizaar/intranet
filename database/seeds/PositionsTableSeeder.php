<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = collect(['Climatologist','Research Assistant','GIS Developer','GIS Analyst','Administrator', 'Climate Scientist', 'IT Specialist','Researcher','Legal Advisor','Research Scientist','Project Administrator','Resilience Officer']);
        $positions->each(function($positionName){
            factory(\App\Position::class)->create([
                 'name' => $positionName                
            ]);
        });
    }
}
