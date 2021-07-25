<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class CreateViewSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'SELECT s.*, u_rejected.name AS user_rejected, u_delivery.name AS user_delivery
        FROM submissions s
        LEFT JOIN users u_rejected ON u_rejected.id = s.rejected_by
        LEFT JOIN users u_delivery ON u_delivery.id = s.delivery_by
        WHERE s.is_deleted = "0"';

        Schema::createOrReplaceView('view_submissions', $query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_submissions');
    }
}
