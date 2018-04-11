@extends('layouts.app')

@role('mentor')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('mentor.finished') }}" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
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
		<div class="col-md-8">
			@if($tasklist->report)
			<div class="panel panel-default">
				<div class="panel-heading">Report</div>

				<div class="panel-body">
					{{ $tasklist->report->contents }}
				</div>
				@if($tasklist->report->file)
				<div class="panel-footer">
					<a 
						href="{{ route('file.download', $tasklist->report->id) }}"
						class="btn btn-primary">
						<i class="fa fa-file"></i> File
					</a>
				</div>
				@endif
			</div>
			@endif
		</div>
	</div>

@endsection

@endrole
