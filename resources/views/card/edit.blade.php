@extends('layouts.app')

@section('content')
    <h1>@lang('card.edit.title')</h1>

    <div class="row">
        <div class="col-xl-4 col-md-6">
            <p>
                <img src="{{ $card->image_url }}" class="img-fluid img-thumbnail"/>
            </p>
        </div>

        <div class="col-xl-8 col-md-6">
            {{ Form::open(['route' => ['cards.update', $card], 'method' => 'put', 'role' => 'form']) }}
                @include('card._form', ['submitTitle' => __('common.update')])
            {{ Form::close() }}
        </div>
    </div>
@endsection