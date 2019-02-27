<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Set;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * @var array
     */
    private $validationRules = [
        'card_identifier' => ['required', 'alpha_num'],
        'set_identifier' => ['required', 'alpha_num'],
    ];

    /**
     * @var string
     */
    private $redirectRoute = 'cards.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = auth()->user()->sets()->whereHas('cards')->with('cards')->orderBy('identifier')->get();

        $sets = $sets->map(function (Set $set) {
            $foundSet = json_decode(fetchSet($set->identifier));

            if (empty($foundSet)) {
                return $set;
            }

            $set->info = $foundSet;

            $set->cards = $set->cards->map(function (Card $card, $i) use ($set) {
                $card->info = json_decode(fetchCardFromSet($set->identifier, $card->identifier));
                $card->image_url = getCardImageUrl($set->identifier, $card->identifier);

                return $card;
            });

            return $set;
        });

        return view('card.index', compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card = new Card();

        return view('card.create', compact('card'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);

        $card = new Card(['identifier' => $data['card_identifier']]);

        $set = $this->findOrCreateSet($data['set_identifier']);
        $card->set_id = $set->id;

        auth()->user()->cards()->save($card);

        flash()->success(__('card.create.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        $card->image_url = $card->image_url = getCardImageUrl($card->set->identifier, $card->identifier);

        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $data = $request->validate($this->validationRules);

        $set = $this->findOrCreateSet($data['set_identifier']);
        $card->set_id = $set->id;
        $card->fill(['identifier' => $data['card_identifier']]);

        auth()->user()->cards()->save($card);

        flash()->success(__('card.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        flash()->success(__('card.destroy.success'));

        return redirect()->route($this->redirectRoute);
    }

    public function showImportForm()
    {
        $sampleContent = "# Sample:\nLOD-001\nSDP-001";

        return view('card.show_import_form', compact('sampleContent'));
    }

    public function submitImport(Request $request)
    {
        $cardSetStrings = explode("\n", $request->get('content'));

        array_map(function ($cardSetStr) {
            list($setIdentifier, $cardIdentifier) = explode('-', $cardSetStr);

            $set = $this->findOrCreateSet($setIdentifier);

            $card = new Card();
            $card->set_id = $set->id;
            $card->identifier = $cardIdentifier;

            auth()->user()->cards()->save($card);
        }, $cardSetStrings);

        flash()->success(__('card.submit_import.success'));

        return redirect()->route($this->redirectRoute);
    }

    private function findOrCreateSet($setIdentifier)
    {
        $set = auth()->user()->sets()->whereIdentifier($setIdentifier)->first() ?? new Set(['identifier' => $setIdentifier]);

        auth()->user()->sets()->save($set);

        return $set;
    }
}
