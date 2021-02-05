<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsInDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('email');
            $table->boolean('verified')->default(false);
            $table->string('verified_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['verified','verified_token']);
        });
    }
}
