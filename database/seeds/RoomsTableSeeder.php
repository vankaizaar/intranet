<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = collect(['Meeting Room 1','Meeting Room 2', 'Board Room 1', 'Board Room 2','Hall 1','Hall 2']);
        $rooms->each(function($roomName){
            factory(\App\Room::class)->create([
                 'room_name' => $roomName
            ]);
        });
    }
}
