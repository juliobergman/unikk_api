<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->foreign('company_id')->references('id')->on('companies');
            $table->enum('type', ['income', 'balance', 'ratio']);
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('identifier')->nullable();
            $table->string('table')->nullable();
            $table->string('category_name')->nullable();
            $table->string('group_name')->nullable();

            $table->unique(['company_id','identifier'], 'unicus');

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
        Schema::dropIfExists('formulas');
    }
}
