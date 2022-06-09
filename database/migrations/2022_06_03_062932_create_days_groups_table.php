<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days_groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('placesgroups');



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
        Schema::dropIfExists('days_groups');
    }
}
