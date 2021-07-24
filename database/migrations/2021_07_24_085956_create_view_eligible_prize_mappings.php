<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class CreateViewEligiblePrizeMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'SELECT epm.id, epm.product_subscription_id, epm.prize_list_id, ps.product_subscription_name,
        ps.product_tag, pl.prize_name, epm.is_deleted, u_created.name AS user_created_by,
        u_updated.name AS user_updated_by, u_deleted.name AS user_deleted_by
        FROM eligible_prize_mappings epm
        INNER JOIN product_subscriptions ps ON ps.id = epm.product_subscription_id
        INNER JOIN prize_lists pl ON pl.id = epm.prize_list_id
        LEFT JOIN users u_created ON u_created.id = epm.created_by
        LEFT JOIN users u_updated ON u_updated.id = epm.updated_by
        LEFT JOIN users u_deleted ON u_deleted.id = epm.deleted_by
        WHERE epm.is_deleted = "0"';

        Schema::createOrReplaceView('view_eligible_prize_mappings', $query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropViewIfExists('view_eligible_prize_mappings');
    }
}
