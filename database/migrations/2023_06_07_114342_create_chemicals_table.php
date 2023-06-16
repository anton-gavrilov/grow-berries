<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chemical_brand_id');
            $table->string('name');
            $table->string('logo');
            $table->string('registrant');
            $table->enum('type', ['pesticide', 'herbicide', 'insecticide', 'fungicide',
                'growth_regulator', 'desiccants']);
            $table->string('package');
            $table->string('active_substance');
            $table->string('chemical_class');
            $table->string('hazard_class');
            $table->string('hazard_class_bees');
            $table->string('preparative_form');
            $table->string('shelf_life');
            $table->text('description');
            $table->text('usage_recommendations');


            $table->foreign('chemical_brand_id')
                ->references('id')
                ->on('chemical_brands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemicals');
    }
};
