@extends('layouts.app')

@section('content')
    <h1>@lang('set.edit.title', ['title' => $set->identifier])</h1>

    {{ Form::open(['route' => ['sets.update', $set], 'method' => 'put', 'role' => 'form']) }}
        @include('set._form', ['submitTitle' => __('common.update')])
    {{ Form::close() }}
@endsection