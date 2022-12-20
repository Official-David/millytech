<?php

use App\Models\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTradeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_items', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });
        Schema::table('trade_items', function (Blueprint $table) {
            $table->string('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_items', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class);
        });
        Schema::table('trade_items', function (Blueprint $table) {
            $table->dropColumn('currency');
        });
    }
}
