<table class="table table-responsive" id="provincias-table">
    <thead>
        <th>Name</th>
        <th>Region Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($provincias as $provincia)
        <tr>
            <td>{!! $provincia->name !!}</td>
            <td>{!! $provincia->region_id !!}</td>
            <td>{!! $provincia->created_at !!}</td>
            <td>{!! $provincia->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['provincias.destroy', $provincia->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('provincias.show', [$provincia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('provincias.edit', [$provincia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>