@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>@lang('card.edit.title')</h1>

        {{ Form::open(['route' => ['cards.update', $card], 'method' => 'post', 'role' => 'form']) }}
            @include('card._form', ['submitTitle' => __('common.update')])
        {{ Form::close() }}
    </div>
@endsection