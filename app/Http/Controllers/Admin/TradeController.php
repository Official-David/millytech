<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trade;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{

    public function index()
    {
        $admin = auth()->user();
        if (!$admin->super) {
            $allowed_cards = DB::table('admin_gift_card')->where('admin_id', $admin->id)->pluck('gift_card_id')->toArray();
            $trades = Trade::latest()->whereHasMorph(
                'tradeable',
                [GiftCard::class],
                fn(Builder $query) => $query->whereIn('id', $allowed_cards)
            )->paginate();
        } else {
            $trades = Trade::latest()->paginate();
        }
        return view('admin.trade.index', compact('trades'));
    }


    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'string|in:pending,processing,rejected'
        ]);
        $giftcard = Trade::findOrFail($id);
        $giftcard->update(['status' => $request->status]);
        return response()->json();
    }

    public function payForm($id)
    {
        $trade = Trade::findOrFail($id);
        $html = view('includes.pay-form', ['trade' => $trade])->render();
        return response()->json(['html' => $html]);

    }

    public function pay(Request $request, $id)
    {
        // $request->validate(['receipt' =>'required|mimes:png,jpg,jpeg']);
        // $filename = str_replace(' ','-',rand().now()->toDateTimeString().'.'.$request->file('receipt')->extension());
        // $request->file('receipt')->move(public_path(config('dir.receipts')),$filename);
        $trade = Trade::findOrFail($id);
        // $trade->receipt = $filename;
        $trade->status = 'paid';
        $trade->save();
        return back()->with('success', 'Trade marked as paid');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trade = Trade::findOrFail($id);
        $html = view('includes.trade-details', compact('trade'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
