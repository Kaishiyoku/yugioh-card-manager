@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>@lang('card.create.title')</h1>

        {{ Form::open(['route' => 'cards.store', 'method' => 'post', 'role' => 'form']) }}
            @include('card._form', ['submitTitle' => __('common.create')])
        {{ Form::close() }}
    </div>
@endsection