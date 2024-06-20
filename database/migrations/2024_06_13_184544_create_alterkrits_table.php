<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alterkrits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alternatif')->constrained('alternatifs');
            $table->foreignId('id_kriteria')->constrained('kriterias');
            $table->enum('faktor', ['core', 'secondary']);
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
        Schema::dropIfExists('alterkrits');
    }
};
