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
        Schema::create('mutexessisler', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('sahe');
            $table->string('img');
            $table->bigInteger('user_id');
            $table->bigInteger('kateqoriya_id');
            $table->string('seher')->default('Təyin Edilmiyib');
            $table->integer('yas');
            $table->string('cins');
            $table->string('telefon')->default('Təyin Edilməyib');
            $table->string('email');
            $table->text('bacariqlar');
            $table->text('tehsil');
            $table->string('is_tecrubesi');
            $table->text('elave');
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
        Schema::dropIfExists('mutexessisler');
    }
};
