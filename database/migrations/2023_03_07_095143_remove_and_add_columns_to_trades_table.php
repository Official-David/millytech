<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAndAddColumnsToTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('reject_message');
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->text('feedback_message')->nullable()->after('status');
            $table->string('feedback_image')->nullable()->after('feedback_message');
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
            $table->text('reject_message')->nullable()->after('status');
        });
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('feedback_message', 'feedback_image');
        });
    }
}