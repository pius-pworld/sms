<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterDistrictsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function(Blueprint $table)
        {
            $table->integer('countries_id')->unsigned()->nullable()->index();
            $table->dropColumn('counties_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('districts', function(Blueprint $table)
        {
            $table->dropColumn('countries_id');
            $table->integer('counties_id')->unsigned()->nullable()->index();

        });
    }
}
