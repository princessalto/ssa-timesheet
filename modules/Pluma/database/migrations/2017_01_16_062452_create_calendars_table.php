<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->index();
            $table->dateTime('datetime');

            $table->boolean('weekend');

            $table->unsignedInteger('day');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->unsignedInteger('week');
            $table->unsignedInteger('weekday');

            $table->string('month_name', 16);
            $table->string('weekday_name', 16);
            $table->string('holiday');

            # Index
            $table->index(['year', 'month', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
