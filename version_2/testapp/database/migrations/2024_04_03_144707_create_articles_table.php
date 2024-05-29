articles : 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     

    //Run the migrations.*/
      public function up(): void{Schema::create('articles', function (Blueprint $table) {$table->integer('GA_CODEARTICLE')->primary();$table->string('GA_LIBELLE');$table->string('GA_FAMILLENIV1')->nullable();$table->string('GA_FAMILLENIV2')->nullable();$table->string('GA_FAMILLENIV3')->nullable();$table->timestamps();



            $table->foreign('GA_FAMILLENIV1')->references('CC_CODE')->on('choix_cat');
            $table->foreign('GA_FAMILLENIV2')->references('CC_CODE')->on('choix_cat');
            $table->foreign('GA_FAMILLENIV3')->references('CC_CODE')->on('choix_cat');
        });
    }


     

    //Reverse the migrations.*/
      public function down(): void{Schema::dropIfExists('articles');}

};