<table class="table table-responsive" id="regions-table">
    <thead>
        <th>Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($regions as $region)
        <tr>
            <td>{!! $region->name !!}</td>
            <td>{!! $region->created_at !!}</td>
            <td>{!! $region->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['regions.destroy', $region->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('regions.show', [$region->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('regions.edit', [$region->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>