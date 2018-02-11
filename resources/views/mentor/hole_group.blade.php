@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-body">
					{!! Form::open([
						'route' => 'mentor.hole_finish',
						'metod' => 'POST'
					]) !!}
					{{ Form::hidden('group_id', $data['group_id']) }}
					{{ Form::hidden('task_id', $data['task_id']) }}
					<div class="form-group">
						{{ Form::label('deadline', 'Deadline:', ['class' => 'control-label']) }}
						{{ Form::date('deadline', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
					</div>
					{{ Form::submit('Give', ['class' => 'btn btn-primary']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-graduation-cap" aria-hidden="true"></i> Group Students
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Surname</th>
									<th>Name</th>
									<th>Patronymic</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data['students'] as $student)
								<tr>
									<td>{{ $student->id }}</td>
									<td>{{ $student->surname }}</td>
									<td>{{ $student->name }}</td>
									<td>{{ $student->patronymic }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
