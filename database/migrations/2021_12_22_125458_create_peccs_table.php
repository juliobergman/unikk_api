<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peccs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->text('region')->nullable();
            $table->string('based')->nullable();
            $table->text('main_countries')->nullable();
            $table->text('main_cities')->nullable();
            $table->text('sector')->nullable();
            $table->text('geo_focus')->nullable();
            $table->text('logo')->nullable();
            $table->text('notes')->nullable();

            // $table->enum('public', ['yes', 'no'])->default('no');

            $table->softDeletes();
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
        Schema::dropIfExists('peccs');
    }
}
