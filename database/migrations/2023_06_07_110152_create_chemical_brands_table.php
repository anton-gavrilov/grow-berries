
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
        Schema::create('chemical_brands', function (Blueprint $table) {
            $table->id();
            $table->string('country', 75);
            $table->string('name', 100);
            $table->string('about', 5000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemical_brands');
    }
};
