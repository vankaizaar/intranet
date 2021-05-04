<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcpacUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();                        
            $table->jsonb('projects')->nullable();
            $table->string('avatar')->nullable()->default("https://i.pravatar.cc/300");

            $table->foreign('department_id')->references('id')->on('departments');
            
            $table->foreign('position_id')->references('id')->on('positions');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        // Fallback for sqlite
        if ($driver === 'sqlite') {
            Schema::dropIfExists('users');

            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telephone');
            $table->dropForeign(['position_id']); 
            $table->dropForeign(['department_id']);                        
            $table->dropColumn('projects');
            $table->dropColumn('avatar');            
        });
    }
}
