@extends('layouts.app')

@role('student')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Student</div>

				<div class="panel-body">
					<span style="color: #595; font-weight: bold;">OK!</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	@foreach($tasks as $task)
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $task->task->title }}</div>

				<div class="panel-body">
					{{ $task->task->description }}
				</div>

				<div class="panel-footer">
					{{ $task->deadline_date }}
				</div>
			</div>
		</div>
	@endforeach
	</div>
@endsection
@endrole
