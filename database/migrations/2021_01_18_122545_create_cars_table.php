<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_code')->nullable();

            $table->foreignId('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();

            $table->foreignId('country_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('city_id')->constrained();

            $table->foreignId('car_body_id')->constrained();
            $table->foreignId('car_weight_id')->constrained();
            $table->bigInteger('push_distance')->default(0);

            $table->bigInteger('is_owner')->default(0);
            $table->bigInteger('is_loc_agree')->default(0);

            $table->string('loc_lat')->nullable();
            $table->string('loc_lng')->nullable();

            $table->dateTime('last_location')->nullable();
            $table->dateTime('date_valid')->nullable();
            $table->bigInteger('available')->default(0);
            $table->bigInteger('status')->default(0);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
