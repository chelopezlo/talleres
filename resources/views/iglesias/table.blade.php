<table class="table table-responsive" id="iglesias-table">
    <thead>
        <th>Name</th>
        <th>Pastor</th>
        <th>Description</th>
        <th>Phone</th>
        <th>Comuna Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($iglesias as $iglesia)
        <tr>
            <td>{!! $iglesia->name !!}</td>
            <td>{!! $iglesia->pastor !!}</td>
            <td>{!! $iglesia->description !!}</td>
            <td>{!! $iglesia->phone !!}</td>
            <td>{!! $iglesia->comuna_id !!}</td>
            <td>{!! $iglesia->created_at !!}</td>
            <td>{!! $iglesia->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['iglesias.destroy', $iglesia->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('iglesias.show', [$iglesia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('iglesias.edit', [$iglesia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>