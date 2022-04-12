<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('chart', ['barChart', 'lineChart', 'pieChart']);
            $table->enum('type', ['income', 'balance', 'ratio']);
            $table->enum('sparkline', ['yes', 'no'])->default('no');
            $table->unsignedBigInteger('sort')->default(1);

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
        Schema::dropIfExists('results');
    }
}
