@extends('layouts.app')

@role('mentor')

@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('mentor.reports') }}" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
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
				<div class="panel-heading">Doer Info</div>

				<div class="panel-body">
					<table class="table table-bordered table-condensed table-hover">
						<tbody>
							<tr>
								<th>Surname:</th>
								<td>{{ $tasklist->doer->surname }}</td>
							</tr>
							<tr>
								<th>Name:</th>
								<td>{{ $tasklist->doer->name }}</td>
							</tr>
							<tr>
								<th>Patronymic:</th>
								<td>{{ $tasklist->doer->patronymic }}</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td>{{ $tasklist->doer->email }}</td>
							</tr>
							@if($tasklist->doer->group_id)
							<tr>
								<th>Group ID:</th>
								<td>{{ $tasklist->doer->group->short_title }}</td>
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
		</div>
		<div class="col-md-6">
			@if($tasklist->report)
			<div class="panel panel-default">
				<div class="panel-heading">Report</div>

				<div class="panel-body">
					<p>{{ $tasklist->report->contents }}</p>
				</div>

				<div class="panel-footer">
					@if($tasklist->report->file)
					<a 
						href="{{ route('file.download', $tasklist->report->id) }}"
						class="btn btn-primary">
						<i class="fa fa-file"></i> File
					</a>
					@endif
					<a href="{{ route('report.apply', [$tasklist->id, 3]) }}" class="btn btn-success">Accept</a>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#msgModal">Decline</button>
				</div>
			</div>
			@endif
		</div>
	</div>

	<!-- Modal -->
	<div id="msgModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Reason Explanation</h4>
				</div>
				{!! Form::open(['route' => ['report.apply', $tasklist->id, 1], 'method' => 'GET', 'data-parsley-validate' => '']) !!}
				<div class="modal-body">
					<div class="form-group">
						{{ Form::label('reason', 'Reason:', ['class' => 'control-label']) }}
						{{ Form::textarea('reason', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'data-parsley-required' => 'true']) }}
					</div>
				</div>
				<div class="modal-footer">
					{!! Form::submit('Decline', ['class' => 'btn btn-danger']) !!}
				</div>
				{!! Form::close() !!}
			</div>

		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection

@endrole
