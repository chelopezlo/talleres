<table class="table table-responsive" id="userTypes-table">
    <thead>
        <th>Role</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userTypes as $userType)
        <tr>
            <td>{!! $userType->role !!}</td>
            <td>{!! $userType->created_at !!}</td>
            <td>{!! $userType->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['userTypes.destroy', $userType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userTypes.show', [$userType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userTypes.edit', [$userType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>