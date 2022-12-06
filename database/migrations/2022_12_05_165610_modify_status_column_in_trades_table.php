<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'paid', 'rejected', 'verified'])->default('pending')->after('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'paid', 'rejected'])->default('pending')->after('total');
        });
    }
}
