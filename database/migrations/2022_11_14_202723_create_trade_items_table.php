<?php

use App\Models\Trade;
use App\Models\Currency;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trade::class);
            $table->foreignIdFor(Currency::class);
            $table->double('amount');
            $table->enum('type', ['ecode', 'physical'])->default('ecode');
            $table->string('image')->nullable();
            $table->string('ecode')->nullable();
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
        Schema::dropIfExists('trade_items');
    }
}
