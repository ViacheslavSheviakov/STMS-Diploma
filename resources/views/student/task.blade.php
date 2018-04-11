@extends('layouts.app')

@role('student')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('home.student') }}" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Giver Info</div>

				<div class="panel-body">
					<table class="table table-bordered table-condensed table-hover">
						<tbody>
							<tr>
								<th>Surname:</th>
								<td>{{ $tasklist->task->creator->surname }}</td>
							</tr>
							<tr>
								<th>Name:</th>
								<td>{{ $tasklist->task->creator->name }}</td>
							</tr>
							<tr>
								<th>Patronymic:</th>
								<td>{{ $tasklist->task->creator->patronymic }}</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td>{{ $tasklist->task->creator->email }}</td>
							</tr>
							@if($tasklist->task->creator->group_id)
							<tr>
								<th>Group ID:</th>
								<td>{{ $tasklist->task->creator->group_id }}</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">{{ $tasklist->task->title }}</div>

				<div class="panel-body">
					{{ $tasklist->task->description }}
				</div>

				<div class="panel-footer">
					{{ $tasklist->deadline_date }}
				</div>
			</div>
			@if($tasklist->comment_id != null)
				<div class="panel panel-info">
					<div class="panel-heading">{{ $tasklist->comment->title }}</div>

					<div class="panel-body">
						<p>
							{{ $tasklist->comment->content }}
						</p>
					</div>

					<div class="panel-footer">
						{{ $tasklist->comment->updated_at }}
					</div>
				</div>
			@endif
		</div>
		@if($tasklist->status == 1)
			<div class="col-md-6">
				{!! Form::open(['route' => 'student.report', 'method' => 'POST', 'files' => 'true', 'data-parsley-validate' => '', 'id' => 'main-form']) !!}
				<div class="panel panel-default">
					<div class="panel-heading">Report</div>

					<div class="panel-body">
						{{ Form::hidden('tasklist_id', $tasklist->id) }}
						<div class="form-group">
							{{ Form::label('content', 'Report Content:', ['class' => 'control-label'])}}
							{{ Form::textarea('content', '', ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
						</div>
						<div class="form-group">
							{{ Form::label('file', 'File (< 10 MB):', ['class' => 'control-label'])}}
							{{ Form::file('file', ['class' => 'form-control', 'data-parsley-max-file-size' => '10240']) }}
						</div>
					</div>

					<div class="panel-footer">
						{{ Form::submit('Send', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		@endif
	</div>

@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/uploads.js') !!}
@endsection
@endrole
