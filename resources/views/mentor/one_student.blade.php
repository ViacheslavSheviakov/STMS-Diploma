@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-body">
					{!! Form::open([
						'route' => 'mentor.one_finish',
						'metod' => 'POST'
					]) !!}
					{{ Form::hidden('student_id', $data['student_id']) }}
					{{ Form::hidden('task_id', $data['task_id']) }}
					<div class="form-group">
						{{ Form::label('deadline', 'Deadline:', ['class' => 'control-label']) }}
						{{ Form::date('deadline', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
					</div>
					{{ Form::submit('Give', ['class' => 'btn btn-primary']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
