<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJubaoPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jubao_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone',15)->default('');
            $table->string('description',50)->default('');
            $table->string('createUser',10)->nullable()->default('admin');
            $table->integer('counter')->length(10)->nullable()->default(0);
            $table->integer('status')->length(2)->nullable()->default(0);
           // $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable()->default(DB::raw('now() on update now() '));
            $table->index('phone');
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
