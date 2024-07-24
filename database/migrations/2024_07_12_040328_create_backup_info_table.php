<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackupInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('server');
            $table->string('database_name');
            $table->dateTime('last_db_backup_date');
            $table->dateTime('backup_start_date');
            $table->bigInteger('backup_size');
            $table->string('physical_device_name');
            $table->string('backupset_name');
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
        Schema::dropIfExists('backup_info');
    }
}
