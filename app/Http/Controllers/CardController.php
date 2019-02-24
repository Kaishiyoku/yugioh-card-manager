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
        'identifier' => ['required', 'alpha_num'],
        'set_name' => ['required', 'alpha_num'],
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
        $sets = auth()->user()->sets()->whereHas('cards');

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

        $card = new Card($data);

        $set = $this->findOrCreateSet($data['set_name']);
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

        $set = $this->findOrCreateSet($data['set_name']);
        $card->set_id = $set->id;
        $card->fill($data);

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

    private function findOrCreateSet($setName)
    {
        $set = auth()->user()->sets()->whereName($setName)->first() ?? new Set(['name' => $setName]);

        auth()->user()->sets()->save($set);

        return $set;
    }
}
