<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_event', function (Blueprint $table) {
            $table->id();
            $table->string('event', 300)->nullable();
            $table->dateTime('datefrom')->nullable();
            $table->dateTime('dateto')->nullable();
            $table->string('weekdays', 100);
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
        Schema::dropIfExists('calendar_event');
    }
}
