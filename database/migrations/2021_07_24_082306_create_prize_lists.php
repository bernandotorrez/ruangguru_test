<?php

use App\Models\PrizeLists;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizeLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('prize_lists')) {
            Schema::create('prize_lists', function (Blueprint $table) {
                $table->id();
                $table->string('prize_name', 100);
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
        PrizeLists::create([
            'prize_name' => 'Shoes',
            'is_deleted' => '0',
            'created_by' => '1'
        ]);
        PrizeLists::create([
            'prize_name' => 'Bag',
            'is_deleted' => '0',
            'created_by' => '1'
        ]);
        PrizeLists::create([
            'prize_name' => 'Pencils',
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
        Schema::dropIfExists('prize_lists');
    }
}
