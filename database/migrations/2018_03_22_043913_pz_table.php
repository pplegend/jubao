<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pz_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->length(30)->nullable()->default(0)->comment('举报标题');
            $table->string('body',500)->default('')->comment('举报详情');
            $table->string('url',200)->comment('图片地址,json格式');
            $table->string('author',20)->nullable()->default('admin')->comment('举报人');
            $table->integer('count')->length(2)->nullable()->default(0)->comment('查看次数');
            $table->tinyInteger('status')->nullable()->default(0)->comment('帖子状态,0:未审核，1:审核通过,2:未通过审核');
            $table->tinyInteger('type')->nullable()->default(0)->comment('举报类型，1：手机号，2：QQ，3：网站，4：公司，5：邮箱，6：微信,7:银行卡,8:其它');
            $table->ipAddress('visitor')->nullable()->default('')->comment('访问者ip');
            $table->timestamp('created_at')->nullable()->default(DB::raw('now()'))->comment('创建时间');
            $table->timestamp('updated_at')->nullable()->default(DB::raw('now() on update now() '))->comment('更新时间');
            $table->unique('title', 'pz_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pz_table');
    }
}
