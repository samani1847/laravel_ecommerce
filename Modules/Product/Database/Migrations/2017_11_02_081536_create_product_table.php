<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price');
            $table->integer('subcategory_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('sample_file')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('sample_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
