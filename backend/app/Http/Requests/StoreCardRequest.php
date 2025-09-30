<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_number' => ['required','digits:20','unique:cards,card_number'],
            'pin' => ['required','digits:4'],
            'activated_at' => ['required','date_format:Y-m-d H:i'],
            'expires_at' => ['required','date_format:Y-m-d'],
            'balance' => ['required','numeric','min:0'],
        ];
    }
}
