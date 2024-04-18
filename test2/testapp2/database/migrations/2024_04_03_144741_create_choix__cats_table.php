choix_cat : 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     

    //Run the migrations.*/
      public function up(): void{Schema::create('choix_cat', function (Blueprint $table) {
        $table->string('CC_CODE')->primary();
        $table->string('CC_LIBELLE');
        $table->string('CC_ABREGE');
        $table->string('CC_LIBRE');
        $table->string('CC_TYPE');
        $table->timestamps();});}


     

    //Reverse the migrations.*/
      public function down(): void{Schema::dropIfExists('choix_cat');}

};