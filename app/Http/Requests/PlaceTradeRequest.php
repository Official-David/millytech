<?php

namespace App\Http\Requests;

use App\Rules\CustomRequiredIf;
use App\Rules\Imageable;
use Illuminate\Foundation\Http\FormRequest;
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
            'cards.*.image' => [new CustomRequiredIf('type', 'physical', 'image'), new Imageable(['png', 'jpeg', 'jpg'])],
            'cards.*.ecode' => [new CustomRequiredIf('type', 'ecode', 'ecode')],
        ];
    }

    public function attributes()
    {
        return [
            'cards.*.currency' => 'currency',
            'cards.*.amount' => 'amount',
            'cards.*.type' => 'type',
            'cards.*.ecode' => 'ecode',
            'cards.*.image' => 'image',
        ];
    }
}
