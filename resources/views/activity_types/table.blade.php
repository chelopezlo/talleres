<table class="table table-responsive" id="activityTypes-table">
    <thead>
        <th>Code</th>
        <th>Name</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($activityTypes as $activityType)
        <tr>
            <td>{!! $activityType->code !!}</td>
            <td>{!! $activityType->name !!}</td>
            <td>{!! $activityType->description !!}</td>
            <td>{!! $activityType->created_at !!}</td>
            <td>{!! $activityType->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['activityTypes.destroy', $activityType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('activityTypes.show', [$activityType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('activityTypes.edit', [$activityType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>