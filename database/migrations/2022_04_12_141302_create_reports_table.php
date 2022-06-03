<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('row')->nullable();
            // Keys
            $table->foreignId('company_id')->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('type', ['income', 'balance', 'ratio']);
            $table->unsignedBigInteger('year');
            $table->unsignedBigInteger('depth')->index();
            $table->unsignedBigInteger('level')->index();
            $table->enum('section', ['actual', 'forecast']);
            // Unique
            $table->unique(['company_id','type', 'depth', 'section', 'name', 'year'], 'unicus');
            
            $table->string('name')->nullable();
            $table->unsignedBigInteger('account')->nullable();
            
            
            $table->string('group_name')->nullable();
            $table->string('format')->default('currency');
            $table->string('row_class')->nullable();

            $table->decimal('jan', 20,2,false)->nullable();
            $table->decimal('feb', 20,2,false)->nullable();
            $table->decimal('mar', 20,2,false)->nullable();
            $table->decimal('qr1', 20,2,false)->nullable();
            $table->decimal('apr', 20,2,false)->nullable();
            $table->decimal('may', 20,2,false)->nullable();
            $table->decimal('jun', 20,2,false)->nullable();
            $table->decimal('qr2', 20,2,false)->nullable();
            $table->decimal('jul', 20,2,false)->nullable();
            $table->decimal('aug', 20,2,false)->nullable();
            $table->decimal('sep', 20,2,false)->nullable();
            $table->decimal('qr3', 20,2,false)->nullable();
            $table->decimal('oct', 20,2,false)->nullable();
            $table->decimal('nov', 20,2,false)->nullable();
            $table->decimal('dec', 20,2,false)->nullable();
            $table->decimal('qr4', 20,2,false)->nullable();
            $table->decimal('yar', 20,2,false)->nullable();

            $table->boolean('is_hidden')->default(0);
            $table->boolean('required')->default(0);

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
        Schema::dropIfExists('reports');
    }
}