<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $inscripcion->id !!}</p>
</div>

<!-- Deposit Number Field -->
<div class="form-group">
    {!! Form::label('deposit_number', 'Deposit Number:') !!}
    <p>{!! $inscripcion->deposit_number !!}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{!! $inscripcion->code !!}</p>
</div>

<!-- Persona Id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    <p>{!! $inscripcion->persona_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $inscripcion->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $inscripcion->updated_at !!}</p>
</div>

