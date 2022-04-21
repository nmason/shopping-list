<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("item_id")->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer("quantity");
            $table->boolean("purchased")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_lists');
    }
};
