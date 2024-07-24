<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('server');
            $table->integer('cpu_utilization');
            $table->integer('cpu_sql_util')->nullable();
            $table->bigInteger('total_memory_mb')->nullable();
            $table->bigInteger('memory_in_use_mb')->nullable();
            $table->bigInteger('sql_memory_mb')->nullable();
            $table->float('disk_size')->nullable();
            $table->float('data_size')->nullable();
            $table->float('used_data_size')->nullable();
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
        Schema::dropIfExists('cpu');
    }
}
