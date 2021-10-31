<div class="table-responsive">
    <table class="table" id="employees-table">
        <thead>
            <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Wage</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @if(!empty($employees))
        @foreach($employees as $employee)
            <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->wage }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('employees.show', [$employee->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('employees.edit', [$employee->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
