<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_code')->nullable();
            $table->foreignId('user_id')->constrained();

            $table->foreignId('country_id_from')->constrained();
            $table->foreignId('region_id_from')->constrained();
            $table->foreignId('city_id_from')->constrained();

            $table->foreignId('country_id_to')->constrained();
            $table->foreignId('region_id_to')->constrained();
            $table->foreignId('city_id_to')->constrained();

            $table->string('loc_lat_from')->nullable();
            $table->string('loc_lng_from')->nullable();
            $table->string('loc_lat_to')->nullable();
            $table->string('loc_lng_to')->nullable();
            $table->bigInteger('distance')->default(0);

            $table->string('cargo_name')->nullable();
            $table->text('cargo_name_slug')->nullable();

            $table->foreignId('car_weight_id')->constrained();
            $table->foreignId('car_body_id')->constrained();
            $table->bigInteger('price')->default(0);
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('price_type_id')->constrained();
            $table->foreignId('pay_type_id')->constrained();

            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('owner_type')->nullable();

            $table->bigInteger('views')->default(0);
            $table->bigInteger('calls')->default(0);
            $table->bigInteger('hot')->default(0);
            $table->dateTime('date_valid')->nullable();
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
        Schema::dropIfExists('cargos');
    }
}
