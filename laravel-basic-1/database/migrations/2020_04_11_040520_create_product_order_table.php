<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100);
            $table->string('name');
            $table->decimal('price',18);
            $table->tinyInteger('qty');
            $table->string('img'); 

            //tạo khoá ngoại
            $table->bigInteger('order_id')->unsigned();
            //tạo liên kết khoá ngoại
            //ghi chú: onDelete('cascade') giúp xoá khoá chính liên kết với khoá ngoại
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order');
    }
}
