<!-- From Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from', 'From:') !!}
    {!! Form::date('from', null, ['class' => 'form-control']) !!}
</div>

<!-- To Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to', 'To:') !!}
    {!! Form::date('to', null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_id', 'Activity Id:') !!}
    {!! Form::number('activity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('activitySchedules.index') !!}" class="btn btn-default">Cancel</a>
</div>
