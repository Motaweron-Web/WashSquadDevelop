<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionDayGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_day_groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')
                ->references('id')->on('distribution_days')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('placesgroups')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->enum('status',['0','1'])->default('0');

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
        Schema::dropIfExists('distribution_day_groups');
    }
}
