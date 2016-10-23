<table class="table table-responsive" id="inscripcions-table">
    <thead>
        <th>Deposit Number</th>
        <th>Code</th>
        <th>Persona Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($inscripcions as $inscripcion)
        <tr>
            <td>{!! $inscripcion->deposit_number !!}</td>
            <td>{!! $inscripcion->code !!}</td>
            <td>{!! $inscripcion->persona_id !!}</td>
            <td>{!! $inscripcion->created_at !!}</td>
            <td>{!! $inscripcion->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['inscripcions.destroy', $inscripcion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inscripcions.show', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inscripcions.edit', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>