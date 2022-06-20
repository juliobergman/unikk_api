<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparklinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparklines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->foreign('company_id')->references('id')->on('companies');
            $table->foreignId('report_id')->foreign('report_id')->references('id')->on('reports');
            
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
        Schema::dropIfExists('sparklines');
    }
}
