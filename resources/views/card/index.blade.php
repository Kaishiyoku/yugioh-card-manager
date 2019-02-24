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
        @foreach ($sets->get() as $set)
            <h5 class="pt-3">
                {{ $set->identifier }}

                <small class="text-muted">
                    {{ $set->cards()->count() }}
                </small>
            </h5>

            <table class="table table-sm table-striped table-hover">
                <tbody>
                    @foreach ($set->cards as $card)
                        <tr>
                            <td>
                                {{ $card->identifier }}
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