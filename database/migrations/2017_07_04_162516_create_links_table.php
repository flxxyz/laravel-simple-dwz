<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('as')->nullable();  // 别名
            $table->string('hash', 8)->unique();  // 生成唯一标识
            $table->string('uri');
            $table->ipAddress('ip')->nullable();  // 记录发布IP
            $table->string('created_at',20)->default(0);
            $table->string('updated_at',20)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
