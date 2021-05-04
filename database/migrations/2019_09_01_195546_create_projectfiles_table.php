<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); 
            $table->unsignedBigInteger('project_id');      
            $table->jsonb('attachment');
            $table->boolean('is_private')->default(0);
            $table->string('cover_image');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projectfiles', function (Blueprint $table) {            
            $table->dropForeign(['project_id']);                                             
        });
        Schema::dropIfExists('projectfiles');
    }
}
