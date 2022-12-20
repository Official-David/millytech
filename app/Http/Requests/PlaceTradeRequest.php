<?php

namespace App\Http\Requests;

use App\Rules\CustomRequiredIf;
use App\Rules\Imageable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class PlaceTradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'giftcard' => 'required|numeric',
            'cards.*.currency' => ['required', 'numeric'],
            'cards.*.amount' => ['required', 'numeric'],
            'cards.*.type' => ['required', 'in:ecode,physical'],
            'cards.*.image' => ['required_if:cards.*.type,physical', new Imageable(['png', 'jpeg', 'jpg'])],
            'cards.*.ecode' => ['required_if:cards.*.type,ecode'],
        ];
    }

    public function attributes()
    {
        return [
            'cards.*.currency' => 'currency',
            'cards.*.amount' => 'amount',
            'cards.*.type' => 'card type',
            'cards.*.ecode' => 'ecode',
            'cards.*.image' => 'image',
        ];
    }
}
