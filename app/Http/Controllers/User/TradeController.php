<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\PlaceTradeRequest;
use App\Models\User;
use App\Models\Trade;
use App\Models\Currency;
use App\Models\GiftCard;
use App\Rules\Imageable;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\Trade\SendNewTrade;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Validation\Rules\Base64;
use Intervention\Image\ImageManagerStatic;

class TradeController extends Controller
{

    private $files = [];
    public function index()
    {
        $giftcards = GiftCard::where('status', 'active')->get();
        return view('user.trades.index', compact('giftcards'));
    }

    public function addCard($id)
    {
        $currencies = GiftCard::findOrFail($id)->currencies;
        $html = view('components.giftcard-details', compact('currencies'))->render();
        return response()->json(compact('html'));
    }

    public function place(PlaceTradeRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = auth(config('fortify.guard'))->user();
            if (is_null($user->bank)) {
                return response()->json([
                    'message' => 'You need to link a bank account. Go to settings.',
                    'redirect_uri' => route('user.settings.bank.details')
                ], 400);
            }
            $giftcard = GiftCard::findOrFail($request->input('giftcard'));
            $total = 0;
            $trade_items = [];

            foreach ($request->input('cards') as $card) {
                $currency = Currency::findOrFail($card['currency']);
                $total += ($card['type'] == 'ecode' ? $currency->ecode_rate : $currency->rate) * $card['amount'];
                array_push(
                    $trade_items,
                    array_merge(
                        [
                            'currency' => $currency->name,
                            'amount' => $card['amount'],
                            'type' => $card['type'],
                        ],
                        $card['type'] == 'ecode' ?
                        [
                            'ecode' => $card['ecode']
                        ] :
                        [
                            'image' => $this->uploadImage($card['image'])
                        ]
                    )
                );

            }
            $trade = $giftcard->trades()->create([
                'user_id' => $user->id,
                'total' => $total,
            ]);

            $trade->trade_items()->createMany($trade_items);
            DB::commit();
            Mail::to($giftcard->admins)->send(new SendNewTrade($trade));
            return response()->json([
                'message' => 'Card traded, please wait for admin approval',
                'redirect_uri' => route('user.trades.history'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            $this->deleteCardImages();
            return response()->json([
                'message' => 'An error occurred and we unable to make your trade.',
            ], 500);
        }

    }

    private function deleteCardImages()
    {
        $images = $this->files;
        if (is_array($images) && count($images)) {
            foreach ($images as $image) {
                if (file_exists($file = storage_path('app/public/card_images/') . $image)) {
                    unlink($file);
                }
            }
        }
    }

    private function uploadImage(string $imageString): string
    {
        $dir = storage_path('app/public/card_images/');
        if (!is_dir($dir)) {
            mkdir($dir, 755);
        }
        $filename = $dir . rand() . Str::random('40') . '.png';
        array_push($this->files, $filename);
        $image = (new ImageManager())->make($imageString);
        $image->save($filename, 80, 'png');
        return basename($filename);
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
        return view('user.trades.history', compact('user', 'trades'));
    }

    public function show($id)
    {
        $trade = Trade::findOrFail($id);
        $html = view('includes.trade-details', ['trade' => $trade])->render();
        return response()->json(compact('html'));
    }

    public function showStatus($id)
    {
        $trade = Trade::findOrFail($id);
        $html = view('components.giftcard-status-message', ['trade' => $trade])->render();
        return response()->json(compact('html'));
    }
}
