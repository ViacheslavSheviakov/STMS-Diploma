@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data['students'] as $student)
								<tr>
									<td>{{ $student->id }}</td>
									<td>{{ $student->surname }}</td>
									<td>{{ $student->name }}</td>
									<td>{{ $student->patronymic }}</td>
									<td>
										{!! Form::open([
											'route' => 'mentor.one_student',
											'metod' => 'POST'
										]) !!}
										{{ Form::hidden('student_id', $student->id) }}
										{{ Form::hidden('task_id', $data['task_id']) }}
										{{ Form::submit('Select', ['class' => 'btn btn-primary']) }}
										{!! Form::close() !!}
									</td>
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
