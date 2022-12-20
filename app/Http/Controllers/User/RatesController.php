<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function __invoke()
    {
        $giftcards = GiftCard::with('currencies')->paginate(20);
        return view('user.rates', compact('giftcards'));
    }
}
