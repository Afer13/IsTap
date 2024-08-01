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
        Schema::create('elanlar', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('sirket');
            $table->bigInteger('user_id');
            $table->bigInteger('kateqoriya_id');
            $table->integer('emekhaqqi');
            $table->string('seher');
            $table->integer('yas')->nullable();
            $table->string('tehsil')->default('Tələb Olunmur');
            $table->string('is_tecrubesi')->default('Tələb Olunmur');
            $table->date('bitme_tarixi');
            $table->string('elaqedar_sexs')->nullable();
            $table->string('telefon')->nullable();
            $table->string('email')->nullable();
            $table->text('is_melumat');
            $table->text('is_teleb');
            $table->text('elave')->nullable();
            $table->integer('baxis_sayi')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            
            $table->foreign('kateqoriya_id')
                ->references('id')
                ->on('kateqoriya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elanlar');
    }
};
