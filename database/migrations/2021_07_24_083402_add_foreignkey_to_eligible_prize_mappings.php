<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToEligiblePrizeMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('eligible_prize_mappings')) {
            Schema::table('eligible_prize_mappings', function (Blueprint $table) {
                $table->foreign('product_subscription_id')->references('id')->on('product_subscriptions');
                $table->foreign('prize_list_id')->references('id')->on('prize_lists');
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
        Schema::table('eligible_prize_mappings', function (Blueprint $table) {
            $table->dropForeign('product_subscription_id');
            $table->dropForeign('prize_list_id');
            $table->dropForeign('created_by');
            $table->dropForeign('updated_by');
            $table->dropForeign('deleted_by');
        });
    }
}
