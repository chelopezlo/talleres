<table class="table table-responsive" id="activitySchedules-table">
    <thead>
        <th>From</th>
        <th>To</th>
        <th>Activity</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($activitySchedules as $activitySchedule)
        <tr>
            <td>{!! $activitySchedule->from !!}</td>
            <td>{!! $activitySchedule->to !!}</td>
            <td>{!! $activitySchedule->activity->name !!}</td>
            <td>{!! $activitySchedule->created_at !!}</td>
            <td>{!! $activitySchedule->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['activitySchedules.destroy', $activitySchedule->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('activitySchedules.show', [$activitySchedule->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('activitySchedules.edit', [$activitySchedule->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>