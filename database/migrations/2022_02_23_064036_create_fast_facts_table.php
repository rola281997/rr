<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFastFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fast_facts', function (Blueprint $table) {
            $table->id();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('about_us_description_ar')->nullable();
            $table->text('about_us_description_en')->nullable();
            $table->string('happy_clients')->nullable();
            $table->string('employees')->nullable();
            $table->string('expert_developers')->nullable();
            $table->string('successful_projects')->nullable();
            $table->text('video_ar')->nullable();
            $table->text('video_en')->nullable();
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
        Schema::dropIfExists('fast_facts');
    }
}
