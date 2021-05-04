<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');                  
            $table->string('title');
            $table->unsignedBigInteger('media_category_id');         
            $table->jsonb('attachment');      
            $table->timestamps();  
            
            $table->foreign('media_category_id')->references('id')->on('media_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       
        Schema::table('medias', function (Blueprint $table) {            
            $table->dropForeign(['media_category_id']);                                             
        });
        Schema::dropIfExists('medias');
    }
}
