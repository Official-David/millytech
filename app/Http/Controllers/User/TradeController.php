<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Currency;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trade;
use Illuminate\Support\Facades\Storage;

class TradeController extends Controller
{
    public function index()
    {
        $giftcards = GiftCard::all();
        return view('user.trades.index', compact('giftcards'));
    }

    public function place(Request $request)
    {
        $request->validate([
            'giftcard' => 'required|numeric',
            'currency' => 'required|numeric',
            'amount' => 'required|numeric',
            'card_image' => 'required|mimes:png,jpg,jpeg',
        ]);


        $user = auth(config('fortify.guard'))->user();

        if(is_null($user->bank)){
            return back()->with('error','You need to link a bank account. Go to settings.')->withInput();
        }
        $giftcard = GiftCard::findOrFail($request->giftcard);
        $currency = $giftcard->currencies()->where('id',$request->currency)->first();

        $filename = Storage::putFile(config('dir.card_image'), $request->file('card_image'));
        dd($filename);

        $data = array_merge([
            'user_id' => $user->id,
            'total' =>$currency->rate * $request->amount,
            'image' =>basename($filename),
            'rate' => $currency->rate,
            'meta' => ['currency' => $currency->name]
        ], $request->only(['amount']));
        $giftcard->trades()->create($data);
        session()->flash('message','Card traded, please wait for admin approval');
        return redirect()->route('user.trades.history');
    }

    public function currencies($id)
    {
        $giftcard = GiftCard::findOrFail($id);
        $html = view('includes.currencies', ['currencies' => $giftcard->currencies])->render();
        return response()->json(['html' => $html]);
    }

    public function rate($id)
    {
        $currency = Currency::findOrFail($id);
        return response()->json(['rate' => $currency->rate]);
    }

    public function history()
    {
        $user = User::findOrFail(auth(config('fortify.guard'))->user()->id);
        $trades = $user->trades()->latest()->paginate();
        return view('user.trades.history',compact('user','trades'));
    }

    public function show($id)
    {
        $trade = Trade::findOrFail($id);
        $html = view('includes.trade-details',['trade'=>$trade])->render();
        return response()->json(compact('html'));
    }
}
