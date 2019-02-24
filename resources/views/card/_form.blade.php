<div class="form-group row">
    {{ Form::label('set_identifier', __('validation.attributes.set_identifier'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('set_identifier', old('set_identifier', $card->set->identifier ?? null), ['class' => 'form-control' . ($errors->has('set_identifier') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('set_identifier'))
            <div class="invalid-feedback">
                {{ $errors->first('set_identifier') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('card_identifier', __('validation.attributes.card_identifier'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('card_identifier', old('card_identifier', $card->identifier), ['class' => 'form-control' . ($errors->has('card_identifier') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('card_identifier'))
            <div class="invalid-feedback">
                {{ $errors->first('card_identifier') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-10 ml-md-auto">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
</div>