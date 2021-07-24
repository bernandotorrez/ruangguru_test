<?php

use App\Models\EligiblePrizeMappings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligiblePrizeMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('eligible_prize_mappings')) {
            Schema::create('eligible_prize_mappings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_subscription_id')->comment('product_subscription.id');
                $table->unsignedBigInteger('prize_list_id')->comment('prize_list.id');
                $table->enum('is_deleted', ['0', '1'])->default('0');
                $table->unsignedBigInteger('created_by')->comment('user_id')->nullable();
                $table->unsignedBigInteger('updated_by')->comment('user_id')->nullable();
                $table->unsignedBigInteger('deleted_by')->comment('user_id')->nullable();
                $table->dateTime('deleted_date')->nullable();
                $table->timestamps();
            });
        }

        $this->insertData();

    }

    protected function insertData()
    {
        EligiblePrizeMappings::create([
            'product_subscription_id' => '1',
            'prize_list_id' => '1',
            'is_deleted' => '0',
            'created_by' => '1'
        ]);
        EligiblePrizeMappings::create([
            'product_subscription_id' => '2',
            'prize_list_id' => '2',
            'is_deleted' => '0',
            'created_by' => '1'
        ]);
        EligiblePrizeMappings::create([
            'product_subscription_id' => '3',
            'prize_list_id' => '3',
            'is_deleted' => '0',
            'created_by' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eligible_prize_mappings');
    }
}
