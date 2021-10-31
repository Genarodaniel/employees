<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $employee->name }}</p>
</div>

<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', 'Company Id:') !!}
    <p>{{ $employee->company_id }}</p>
</div>

<!-- Position Field -->
<div class="col-sm-12">
    {!! Form::label('position', 'Position:') !!}
    <p>{{ $employee->position }}</p>
</div>

<!-- Wage Field -->
<div class="col-sm-12">
    {!! Form::label('wage', 'Wage:') !!}
    <p>{{ $employee->wage }}</p>
</div>

