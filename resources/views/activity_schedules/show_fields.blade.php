<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $activitySchedule->id !!}</p>
</div>

<!-- From Field -->
<div class="form-group">
    {!! Form::label('from', 'From:') !!}
    <p>{!! $activitySchedule->from !!}</p>
</div>

<!-- To Field -->
<div class="form-group">
    {!! Form::label('to', 'To:') !!}
    <p>{!! $activitySchedule->to !!}</p>
</div>

<!-- Activity Id Field -->
<div class="form-group">
    {!! Form::label('activity_id', 'Activity Id:') !!}
    <p>{!! $activitySchedule->activity_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $activitySchedule->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $activitySchedule->updated_at !!}</p>
</div>

