<!-- Numeber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numeber', 'Numeber:') !!}
    {!! Form::text('numeber', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Register Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('register_number', 'Register Number:') !!}
    {!! Form::number('register_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Used Field -->
<div class="form-group col-sm-6">
    {!! Form::label('used', 'Used:') !!}
    {!! Form::number('used', null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('despositos.index') !!}" class="btn btn-default">Cancel</a>
</div>
