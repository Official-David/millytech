<?php

use App\Models\Admin;
use App\Models\GiftCard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGiftCardsTabe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_gift_card', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(GiftCard::class);
            $table->foreignIdFor(Admin::class);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_gift_card');
    }
}
