<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToQqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pz_qq', function (Blueprint $table) {
            $table->integer('status')->length(2)->nullable()->default(0)->after('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pz_qq', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
