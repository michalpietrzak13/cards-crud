<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cardId = $this->route('card')->id ?? null;

        return [
            'card_number' => ['required','digits:20', Rule::unique('cards','card_number')->ignore($cardId)],
            'pin' => ['required','digits:4'],
            'activated_at' => ['required','date_format:Y-m-d H:i'],
            'expires_at' => ['required','date_format:Y-m-d'],
            'balance' => ['required','numeric','min:0'],
        ];
    }
}
