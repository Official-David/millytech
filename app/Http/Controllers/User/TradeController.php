<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index()
    {
        $giftcards = GiftCard::all();
        return view('user.trades.index',compact('giftcards'));
    }

    public function currencies($id)
    {
        $giftcard = GiftCard::findOrFail($id);
        $html = view('includes.currencies',['currencies' => $giftcard->currencies])->render();
        return response()->json(['html' => $html]);
    }

    public function rate($id)
    {
        $currency = Currency::findOrFail($id);
        return response()->json(['rate' => $currency->rate]);
    }
}
