<table class="table table-responsive" id="activities-table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Color</th>
        <th>Icon</th>
        <th>Is Selectable</th>
        <th>Activity Type Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($activities as $activity)
        <tr>
            <td>{!! $activity->name !!}</td>
            <td>{!! $activity->description !!}</td>
            <td>{!! $activity->color !!}</td>
            <td>{!! $activity->icon !!}</td>
            <td>{!! $activity->is_selectable !!}</td>
            <td>{!! $activity->activity_type_id !!}</td>
            <td>{!! $activity->created_at !!}</td>
            <td>{!! $activity->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['activities.destroy', $activity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('activities.show', [$activity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('activities.edit', [$activity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>