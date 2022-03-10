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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->foreign("exam_id")->references("id")->on("exams")->onDelete("cascade");
            $table->text("question");
            $table->text("option_1");
            $table->text("option_2");
            $table->text("option_3");
            $table->text("option_4");
            $table->text("answer");
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
        Schema::dropIfExists('questions');
    }
};
