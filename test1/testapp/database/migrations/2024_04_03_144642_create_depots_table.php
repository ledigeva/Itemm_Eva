depots: 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
     

    //Run the migrations.*/
      public function up(): void{Schema::create('depots', function (Blueprint $table) {$table->integer('GDE_DEPOT')->primary();$table->text('GDE_LIBELLE');$table->string('url_images')->nullable();$table->string('coordonnees')->nullable();$table->timestamps();});}


    
     

    //Reverse the migrations.*/
      public function down(): void{Schema::dropIfExists('depots');}

};