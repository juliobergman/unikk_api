<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->nullable()->constrained();
            // $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('company_id')->nullable()->onDelete('cascade');
            $table->unique(['user_id','company_id'], 'unique');
            $table->string('job_title')->nullable();
            $table->enum('role', ['user', 'editor', 'admin'])->default('user');
            $table->boolean('selected')->default(false);
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
        Schema::dropIfExists('memberships');
    }
}
