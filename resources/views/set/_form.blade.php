<div class="form-group row">
    {{ Form::label('identifier', __('validation.attributes.identifier'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('identifier', old('identifier', $set->identifier), ['class' => 'form-control' . ($errors->has('identifier') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('identifier'))
            <div class="invalid-feedback">
                {{ $errors->first('identifier') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-10 ml-md-auto">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
</div>