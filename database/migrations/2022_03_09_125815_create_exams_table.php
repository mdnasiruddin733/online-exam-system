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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
            $table->string("title");
            $table->string("type")->default("cq");
            $table->text("instructions")->nullable();
            $table->dateTimeTz("started_at",0)->useCurrent();
            $table->dateTimeTz("ended_at",0)->useCurrent();
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
        Schema::dropIfExists('exams');
    }
};
