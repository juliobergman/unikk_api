<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('format')->nullable();
            $table->unsignedBigInteger('account')->nullable();
            $table->foreignId('company_id')->nullable()->constrained();
            // $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
            ->references('id')
            ->on('categories')
            ->constrained()
            ->onDelete('cascade');
            
            $table->enum('type', ['income', 'balance', 'ratio']);

            $table->unsignedBigInteger('sort')->nullable();

            $table->unique(['account','company_id'], 'unique_account');
            // $table->unique(['name','company_id', 'parent_id'], 'unique_child');

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
        Schema::dropIfExists('categories');
    }
}
