<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); 
            $table->unsignedBigInteger('document_category_id'); 
            $table->jsonb('attachment');
            $table->string('cover_image');
            $table->timestamps();

            $table->foreign('document_category_id')->references('id')->on('document_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {            
            $table->dropForeign(['document_category_id']);                                             
        });
        Schema::dropIfExists('documents');
    }
}
