<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    /**
     * @var array
     */
    private $validationRules = [
        'identifier' => ['required', 'alpha_num'],
    ];

    /**
     * @var string
     */
    private $redirectRoute = 'cards.index';

    public function __construct()
    {
        $this->authorizeResource(Set::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        return view('set.edit', compact('set'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        $data = $request->validate($this->validationRules);

        $set->fill($data);

        auth()->user()->sets()->save($set);

        flash()->success(__('set.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        //
    }
}
