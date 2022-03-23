<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("teacher_id")->references("id")->on("teachers")->onDelete("cascade");
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");
            $table->string("code");
            $table->string("name");
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
        Schema::dropIfExists('courses');
    }
};
