<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $departments = collect(['Marketing & Communication','Human Resources','Administration', 'Research', 'ICT']);

       $departments->each(function($departmentName){
           factory(\App\Department::class)->create([
                'name' => $departmentName                
           ]);
       });

    }
}
