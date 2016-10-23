<table class="table table-responsive" id="despositos-table">
    <thead>
        <th>Numeber</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Register Number</th>
        <th>Used</th>
        <th>Comments</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($despositos as $desposito)
        <tr>
            <td>{!! $desposito->numeber !!}</td>
            <td>{!! $desposito->date !!}</td>
            <td>{!! $desposito->amount !!}</td>
            <td>{!! $desposito->register_number !!}</td>
            <td>{!! $desposito->used !!}</td>
            <td>{!! $desposito->comments !!}</td>
            <td>{!! $desposito->created_at !!}</td>
            <td>{!! $desposito->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['despositos.destroy', $desposito->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('despositos.show', [$desposito->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('despositos.edit', [$desposito->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>