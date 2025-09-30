<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $cards = Card::orderBy('id', 'desc')->paginate(10);
        return response()->json($cards);
    }

    public function store(StoreCardRequest $request)
    {
        $card = Card::create($request->validated());
        return response()->json($card, 201);
    }

    public function show(Card $card)
    {
        return response()->json($card);
    }

    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->update($request->validated());
        return response()->json($card);
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return response()->noContent();
    }
}
