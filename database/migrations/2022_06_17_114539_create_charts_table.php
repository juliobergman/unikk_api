<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            // Keys
            $table->foreignId('company_id')->foreign('company_id')->references('id')->on('companies');
            $table->foreignId('report_id')->foreign('report_id')->references('id')->on('reports');
            $table->string('section')->default('dash-ratio');
            // Unique
            $table->unique(['company_id','report_id'], 'unicus');
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
        Schema::dropIfExists('charts');
    }
}
