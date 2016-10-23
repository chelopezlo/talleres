<table class="table table-responsive" id="userActivities-table">
    <thead>
        <th>Order</th>
        <th>Is Registered</th>
        <th>Registrarion Date</th>
        <th>Registrated By</th>
        <th>Persona Id</th>
        <th>Activity Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userActivities as $userActivity)
        <tr>
            <td>{!! $userActivity->order !!}</td>
            <td>{!! $userActivity->is_registered !!}</td>
            <td>{!! $userActivity->registrarion_date !!}</td>
            <td>{!! $userActivity->registrated_by !!}</td>
            <td>{!! $userActivity->persona_id !!}</td>
            <td>{!! $userActivity->activity_id !!}</td>
            <td>{!! $userActivity->created_at !!}</td>
            <td>{!! $userActivity->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['userActivities.destroy', $userActivity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userActivities.show', [$userActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userActivities.edit', [$userActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>