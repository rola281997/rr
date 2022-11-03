<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappPhoneToContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('whatsapp_phone')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn('whatsapp_phone');
        });
    }
}
