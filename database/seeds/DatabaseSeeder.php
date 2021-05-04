<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);  
        $this->call(RoomsTableSeeder::class); 
        $this->call(DocumentCategoriesTableSeeder::class);   
        $this->call(MediaCategoriesTableSeeder::class);      
        $this->call(UsersTableSeeder::class);           
    }
}
