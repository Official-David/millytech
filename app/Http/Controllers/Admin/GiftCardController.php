<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giftcards = GiftCard::latest()->paginate();
        return view('admin.giftcard.index', compact('giftcards'));
    }

    public function checkName(Request $request)
    {
        // dd($request->input('giftcard_id'));
        $query = GiftCard::where('name', $request->input('name'));

        if ($request->filled('giftcard_id')) {
            $query->where('id', '!=', $request->input('giftcard_id'));
        }

        return response()->json([
            'exists' => $query->exists()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.giftcard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:gift_cards'],
            'status' => ['required', 'in:active,inactive'],
            'meta' => ['required']
        ]);

        $giftcard = GiftCard::create([
            'name' => $request->input('name'),
            'status' => $request->input('status')
        ]);

        $giftcard->currencies()->createMany($request->meta);
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCurrency()
    {
        $html = view('includes.add-currency')->render();
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
        $giftcard = GiftCard::findOrFail($id);
        return view('admin.giftcard.edit', compact('giftcard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('gift_cards')->ignore($id)],
            'status' => ['required', 'in:active,inactive'],
            'meta' => ['required']
        ]);
        $giftcard = GiftCard::findOrFail($id);
        $giftcard->currencies()->delete();
        $giftcard->currencies()->createMany($request->input('meta'));
        $giftcard->update($request->only('name', 'status'));
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giftcard = GiftCard::findOrFail($id);
        $giftcard->delete();
        return redirect()->route('admin.giftcards.index');
    }
}
