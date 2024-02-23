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
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->string('tempatlahir')->nullable();
            $table->date('borndate')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            //
        });
    }
};
