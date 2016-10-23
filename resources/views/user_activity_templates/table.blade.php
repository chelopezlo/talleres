<table class="table table-responsive" id="userActivityTemplates-table">
    <thead>
        <th>Order</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userActivityTemplates as $userActivityTemplate)
        <tr>
            <td>{!! $userActivityTemplate->order !!}</td>
            <td>{!! $userActivityTemplate->created_at !!}</td>
            <td>{!! $userActivityTemplate->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['userActivityTemplates.destroy', $userActivityTemplate->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userActivityTemplates.show', [$userActivityTemplate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userActivityTemplates.edit', [$userActivityTemplate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>