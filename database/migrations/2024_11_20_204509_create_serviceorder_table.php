<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('serviceorder', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('date');
            $table->bigInteger('responsibleTechnicial_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('imei');
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->bigInteger('type_of_equipment_id')->unsigned();
            $table->string('turn_on');
            $table->string('blows');
            $table->string('tactile');
            $table->string('cargo_port');
            $table->string('colour');
            $table->string('password');
            $table->string('failure');
            $table->string('diagnosis');
            $table->string('budget');
            $table->string('repair');
            $table->string('advance');
            $table->string('total');
            $table->json('photos')->default(null);
            $table->string('status')->default('POR REPARAR');
            $table->foreign('responsibleTechnicial_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('brand_id')->references('id')->on('brand');
            $table->foreign('model_id')->references('id')->on('models');
            $table->foreign('type_of_equipment_id')->references('id')->on('typesofequipment');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceorder');
    }
};
