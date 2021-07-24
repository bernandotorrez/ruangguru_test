<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('username', 50);
                $table->string('name', 100);
                $table->string('email', 100)->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password', 100);
                $table->enum('is_admin', ['0', '1'])->default('0')->comment('0 = Guest, 1 = Admin');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        $this->insertData();
    }

    private function insertData()
    {
        User::create([
            'username' => 'bernand',
            'name' => 'Bernand',
            'email' => 'mail.bernand@gmail.com',
            'password' => Hash::make('B3rnando'),
            'is_admin' => '1'
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
