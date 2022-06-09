<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->date('sending_date');
            $table->text('target');
            $table->date('target_date_start');
            $table->date('target_date_end');
            $table->string('ar_title',100);
            $table->string('en_title',100);

            $table->text('ar_text');
            $table->text('en_text');



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
        Schema::dropIfExists('app_notifications');
    }
}
