<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GiftCard;
use Illuminate\Http\Request;

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
        $giftcard = GiftCard::create(['name'=>$request->name]);

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
        return response()->json(['html'=>$html]);
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

        return view('admin.giftcard.edit',compact('giftcard'));
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
        $giftcard = GiftCard::findOrFail($id);
        $giftcard->name = $request->name;
        $giftcard->currencies()->delete();
        $giftcard->currencies()->createMany($request->meta);
        $giftcard->save();
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
