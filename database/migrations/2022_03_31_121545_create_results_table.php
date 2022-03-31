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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->foreign("exam_id")->references('id')->on("exams")->onDelete("cascade");
            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references('id')->on("students")->onDelete("cascade");
            $table->double("marks");
            $table->json("right_answers");
            $table->json("my_answers");
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
        Schema::dropIfExists('results');
    }
};
