<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('submissions')) {
            Schema::table('submissions', function (Blueprint $table) {
                $table->foreign('rejected_by')->references('id')->on('users');
                $table->foreign('delivery_by')->references('id')->on('users');
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
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign('rejected_by');
            $table->dropForeign('delivery_by');
        });
    }
}
