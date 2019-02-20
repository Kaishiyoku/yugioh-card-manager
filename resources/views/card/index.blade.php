@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>@lang('card.index.title')</h1>

        <p>
            <a class="btn btn-outline-primary" href="{{ route('cards.create') }}">{{ __('card.create.title') }}</a>
        </p>

        <table class="table table-condensed table-striped table-hover">
            @foreach ($sets->get() as $set)
                <thead>
                    <tr>
                        <th>
                            {{ $set->name }}
                        </th>
                        <th class="text-right">
                            {{ $set->cards()->count() }}
                        </th>
                    </tr>
                </thead>

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
            @endforeach

            <tfoot>
                <tr>
                    <td class="text-right text-muted" colspan="2">
                        Total: {{ auth()->user()->cards->count() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection