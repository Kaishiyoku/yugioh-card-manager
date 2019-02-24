@extends('layouts.app')

@section('content')
    <h1>@lang('card.edit.title')</h1>

    {{ Form::open(['route' => ['cards.update', $card], 'method' => 'put', 'role' => 'form']) }}
        @include('card._form', ['submitTitle' => __('common.update')])
    {{ Form::close() }}
@endsection