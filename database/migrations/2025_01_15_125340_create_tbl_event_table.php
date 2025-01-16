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
        Schema::create('tbl_event', function (Blueprint $table) {
            $table->bigIncrements('id_event');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('sales');
            $table->string('sh');
            $table->string('brand');
            $table->boolean('hadir')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_event');
    }
};
