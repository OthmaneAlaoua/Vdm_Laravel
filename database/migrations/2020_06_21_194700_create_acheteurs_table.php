<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateAcheteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acheteurs', function ($collection) {
            $collection->index('Civilite');
            $collection->index('Nom');
            $collection->index('Prenom');
            $collection->index('Age');
            $collection->index('Email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acheteurs');
    }
}
