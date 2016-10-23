<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $activity->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $activity->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $activity->description !!}</p>
</div>

<!-- Color Field -->
<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    <p>{!! $activity->color !!}</p>
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{!! $activity->icon !!}</p>
</div>

<!-- Is Selectable Field -->
<div class="form-group">
    {!! Form::label('is_selectable', 'Is Selectable:') !!}
    <p>{!! $activity->is_selectable !!}</p>
</div>

<!-- Activity Type Id Field -->
<div class="form-group">
    {!! Form::label('activity_type_id', 'Activity Type Id:') !!}
    <p>{!! $activity->activity_type_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $activity->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $activity->updated_at !!}</p>
</div>

