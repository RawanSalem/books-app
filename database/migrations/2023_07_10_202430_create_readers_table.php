<?php

use App\Enums\GenderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->string('name');
            $table->integer('followers');
            $table->date('birth_date')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();
            $table->tinyInteger('gender')->default(GenderType::NOT_SPECIFIED);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readers');
    }
}
