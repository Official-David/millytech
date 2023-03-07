<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trade;
use App\Models\GiftCard;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class TradeController extends Controller
{

    public function index(Request $request)
    {
        $admin = auth()->user();
        if (!$admin->super) {
            $allowed_cards = DB::table('admin_gift_card')->where('admin_id', $admin->id)->pluck('gift_card_id')->toArray();
            $trades = Trade::latest()->whereHasMorph(
                'tradeable',
                [GiftCard::class],
                fn(Builder $query) => $query->whereIn('id', $allowed_cards)
            );
        } else {
            $trades = Trade::latest();
        }

        $trades->when(
            $request->filled('search'),
            fn (Builder $query) => $query->where(
                'reference',
                $request->input('search')
            )
        );

        $trades->when(
            $request->filled('fstatus'),
            fn(Builder $query) => $query->where(
                'status',
                $request->input('fstatus')
            )
        );

        return view('admin.trade.index', ['trades' => $trades->paginate()->withQueryString()]);
    }

    public function showStatus($id)
    {
        $html = view('components.change-trade-status', [
            'trade' => Trade::findOrFail($id)
        ])->render();

        return response()->json([
            'html' => $html
        ]);
    }


    public function changeStatus(Request $request, $id)
    {
        $valid = $request->validate([
            'status' => [
                'string', 'in:pending,processing,rejected,verified'
            ],
            'reject_message' => [
                'nullable',
                Rule::requiredIf(in_array($request->input('status'), ['rejected', 'verified']))
            ],
            'reject_image'   => [
                'nullable',
                Rule::requiredIf(in_array($request->input('status'), ['rejected', 'verified'])),
                'file',
                'mimes:png,jpeg,jpg'
            ],
        ]);

        $data = $request->only('status');

        if ($request->filled('reject_message')) {
            $data['feedback_message'] = $request->input('reject_message');
        }

        if ($request->hasFile('reject_image')) {
            $dir      = public_path(config('dir.trade_feedback_image'));
            $filename = now()->timestamp . rand() . Str::random(20) . '.' . $request->file('reject_image')->extension();
            $request->file('reject_image')->move($dir, $filename);
            $data['feedback_image'] = $filename;
        }

        Trade::findOrFail($id)->update($data);
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
