<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('designation_id')->nullable()
                ->index()
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('email',32)->unique();
            $table->string('password',255);
            $table->string('assistant_phone')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('country_id')->nullable();
            $table->double('visit_fee')->nullable();
            $table->boolean('is_offday')->default(false);
            $table->string('break_time')->nullable();
            $table->json('education')->nullable();
            $table->string('address')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('resume')->nullable();
            $table->boolean('is_medelist')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('doctors');
    }
}
