<?php

use App\Models\ProductSubcriptions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_subscriptions')) {
            Schema::create('product_subscriptions', function (Blueprint $table) {
                $table->id();
                $table->string('product_subscription_name', 150);
                $table->string('product_tag', 150);
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
        ProductSubcriptions::create([
            'product_subscription_name' => 'English Academy',
            'product_tag' => 'englishacademy',
            'is_deleted' => '0',
            'created_by' => '1',
        ]);
        ProductSubcriptions::create([
            'product_subscription_name' => 'Skill Academy',
            'product_tag' => 'skillacademy',
            'is_deleted' => '0',
            'created_by' => '1',
        ]);
        ProductSubcriptions::create([
            'product_subscription_name' => 'Ruangguru',
            'product_tag' => 'ruangguru',
            'is_deleted' => '0',
            'created_by' => '1',
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_subscriptions');
    }
}
