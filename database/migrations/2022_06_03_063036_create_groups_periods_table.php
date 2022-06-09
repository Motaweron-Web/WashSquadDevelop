<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_periods', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('placesgroups');

            $table->unsignedBigInteger('period_id');
            $table->foreign('period_id')->references('id')->on('periods');


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
        Schema::dropIfExists('groups_periods');
    }
}
