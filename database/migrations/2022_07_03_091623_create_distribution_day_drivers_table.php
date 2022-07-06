<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionDayDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_day_drivers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')
                ->references('id')->on('distribution_days')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('placesgroups')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('distribution_day_drivers');
    }
}
