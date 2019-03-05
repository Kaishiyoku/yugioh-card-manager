@extends('layouts.app')

@section('content')
    <h1>@lang('card.index.title')</h1>

    <p>
        <a class="btn btn-outline-primary" href="{{ route('cards.create') }}">{{ __('card.create.title') }}</a>

        <a class="btn btn-outline-primary" href="{{ route('cards.show_import_form') }}">{{ __('card.show_import_form.title') }}</a>
    </p>

    @if (auth()->user()->cards()->count() == 0)
        <p class="lead">
            <em>{{ __('common.none') }}</em>
        </p>
    @else
        @foreach ($sets as $set)
            <h5 class="pt-4">
                {{ $set->identifier }}

                <small class="text-muted">
                    {{ $set->cards()->count() }}

                    <span class="float-right">
                        {{ Html::linkRoute('sets.edit', __('common.edit'), $set) }}
                    </span>
                </small>
            </h5>

            <div class="pb-2 text-muted">
                <small>
                    {{ __('common.lang.de') }}: {{ objGet('title_german', $set->info) }}
                    &bull;
                    {{ __('common.lang.en') }}: {{ objGet('title_english', $set->info) }}
                </small>
            </div>

            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ __('card.identifier') }}</th>
                        <th>{{ __('card.title_german') }}</th>
                        <th>{{ __('card.title_english') }}</th>
                        <th>{{ __('card.rarity') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($set->cards as $card)
                        <tr>
                            <td>
                                <img height="20px" src="{{ $card->image_url }}" data-toggle="tooltip-html" title="<img src='{{ $card->image_url }}'/>"/>
                                {{ $card->identifier }}
                            </td>
                            <td>
                                {{ objGet('card.title_german', $card->info) }}
                            </td>
                            <td>
                                {{ objGet('card.title_english', $card->info) }}
                            </td>
                            <td>
                                {{ objGet('card_set.rarity', $card->info) }}
                            </td>
                            <td class="text-right">
                                @include('shared._delete_link', ['route' => ['cards.destroy', $card]])
                                <a href="{{ route('cards.edit', $card) }}">{{ __('common.edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <p class="text-muted">
            {{ __('card.index.total') }}:
            {{ auth()->user()->cards()->count() }}
        </p>
    @endif
@endsection