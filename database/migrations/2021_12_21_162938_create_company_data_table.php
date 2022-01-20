<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->default(2);
            $table->foreign('currency_id')->references('id')->on('currencies');
            
            $table->bigInteger('shares')->default(0);
            $table->decimal('taxrate', 20, 2)->default(0);

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('sector')->nullable();
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('info')->nullable();
            $table->string('logo')->nullable();
            // Soft & TimeStamps
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
        Schema::dropIfExists('company_data');
    }
}
