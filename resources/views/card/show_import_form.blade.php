@extends('layouts.app')

@section('content')
    <h1>@lang('card.show_import_form.title')</h1>

    {{ Form::open(['route' => 'cards.submit_import', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group row">
            {{ Form::label('content', __('validation.attributes.content'), ['class' => 'col-lg-2 col-form-label']) }}

            <div class="col-lg-3">
                {{ Form::textarea('content', old('content'), ['class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''), 'required' => true, 'placeholder' => $sampleContent]) }}

                @if ($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-10 ml-md-auto">
                {{ Form::button(__('card.show_import_form.submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection