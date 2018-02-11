@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Groups
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Short Title</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($groups as $group)
								<tr>
									<td>{{ $group->group_id }}</td>
									<td>{{ $group->short_title}}</td>
									<td>
										{!! Form::open([
											'route'  => 'mentor.hole_create',
											'method' => 'POST'
										]) !!}
										{{ Form::hidden('task_id', $task_id) }}
										{{ Form::hidden('group_id', $group->group_id) }}
										{{ Form::submit('All', ['class' => 'btn btn-primary']) }}
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
