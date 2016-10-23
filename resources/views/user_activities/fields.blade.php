<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Registered Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_registered', 'Is Registered:') !!}
    <label class="radio-inline">
        {!! Form::radio('is_registered', "1", null) !!} 1
    </label>
    <label class="radio-inline">
        {!! Form::radio('is_registered', "0", null) !!} 0
    </label>
</div>

<!-- Registrarion Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('registrarion_date', 'Registrarion Date:') !!}
    {!! Form::date('registrarion_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Registrated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('registrated_by', 'Registrated By:') !!}
    {!! Form::text('registrated_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::number('persona_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_id', 'Activity Id:') !!}
    {!! Form::number('activity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userActivities.index') !!}" class="btn btn-default">Cancel</a>
</div>
