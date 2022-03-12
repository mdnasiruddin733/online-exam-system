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
        Schema::create('c_q_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->foreign("exam_id")->references("id")->on("exams")->onDelete("cascade");
            $table->string("file");
            $table->string("marks");
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
        Schema::dropIfExists('c_q_s');
    }
};
