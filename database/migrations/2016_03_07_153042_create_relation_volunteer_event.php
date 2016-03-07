<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationVolunteerEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_volunteer_event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('volunteer_id');
            $table->unsignedInteger('event_id');
            $table->boolean('is_visited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rel_volunteer_event');
    }
}
