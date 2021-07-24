<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Submissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('submissions')) {
            Schema::create('submissions', function (Blueprint $table) {
                $table->id();
                $table->string('user_id', 50);
                $table->text('delivery_address');
                $table->string('contact_number', 15);
                $table->string('contact_person', 100);
                $table->enum('is_eligible', ['0', '1'])->default('0');
                $table->enum('status', ['Crt', 'Dlv', 'Rjt'])->default('Crt')->comment('Rjt = Rejected, Crt = Created, Dlv = Delivery');
                $table->timestamps();
                $table->dateTime('date_rejected');
                $table->unsignedBigInteger('rejected_by')->comment('user_id')->nullable();
                $table->dateTime('date_delivery');
                $table->unsignedBigInteger('delivery_by')->comment('user_id')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
