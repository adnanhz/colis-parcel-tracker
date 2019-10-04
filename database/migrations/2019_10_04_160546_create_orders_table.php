<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("custom_id")->default("");
            $table->string("client_name");
            $table->string("client_phone");
            $table->string("client_address");
            $table->string("additional_info")->default("");
            $table->unsignedBigInteger("user_placed");
            $table->foreign("user_placed")->references("id")->on("users")->onDelete("RESTRICT");
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
        Schema::dropIfExists('orders');
    }
}
