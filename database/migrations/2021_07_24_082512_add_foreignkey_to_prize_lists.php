<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToPrizeLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('prize_lists')) {
            Schema::table('prize_lists', function (Blueprint $table) {
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prize_lists', function (Blueprint $table) {
            $table->dropForeign('created_by');
            $table->dropForeign('updated_by');
            $table->dropForeign('deleted_by');
        });
    }
}
