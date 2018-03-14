<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePzQqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pz_qq', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body',255)->default('');
            $table->string('url',25)->default('');
            $table->string('author',10)->nullable()->default('admin');
            $table->integer('qq')->length(12)->nullable()->default(0);
            $table->integer('status')->length(2)->nullable()->default(0);
             $table->timestamp('created_at')->nullable()->default(DB::raw('now()'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('now() on update now() '));
            $table->index('qq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jubao_phones');

    }
}
