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
        Schema::create('dispos', function (Blueprint $table) {
            $table->id();
            $table->integer('GQ_ARTICLE');
            $table->integer('GQ_DEPOT');
            $table->float('GQ_PHYSIQUE');
            $table->timestamps();


            $table->foreign('GQ_ARTICLE')->references('GA_CODEARTICLE')->on('articles');
            $table->foreign('GQ_DEPOT')->references('GDE_DEPOT')->on('depots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispos');
    }
};