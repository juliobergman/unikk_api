<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facts', function (Blueprint $table) {
            $table->id();

            $table->enum('section', ['actual', 'forecast'])->default('actual');
            $table->date('date')->foreign('date')->references('date')->on('date_dimensions');
            $table->foreignId('category_id')->foreign('category_id')->references('id')->on('categories');
            $table->foreignId('company_id')->constrained();
            // Unique
            // $table->unique(['code_id','date','report_id','company_id'], 'unicus');
            $table->decimal('amount', 20,2,false);
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
        Schema::dropIfExists('facts');
    }
}
