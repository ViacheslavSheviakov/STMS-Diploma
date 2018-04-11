@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-users" aria-hidden="true"></i> Groups
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Short Title</th>
									<th>Full title</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($groups as $group)
								<tr>
									<td>{{ $group->group_id }}</td>
									<td>{{ $group->short_title }}</td>
									<td>{{ $group->full_title }}</td>
									<td>
										{!! Form::open([
											'route'  => 'mentor.hole_create',
											'method' => 'POST',
											'style'  => 'display: inline-block;'
										]) !!}
										{{ Form::hidden('task_id', $task_id) }}
										{{ Form::hidden('group_id', $group->group_id) }}
										{{ Form::submit('All', ['class' => 'btn btn-primary']) }}
										{!! Form::close() !!}

										{!! Form::open([
											'route'  => 'mentor.one',
											'method' => 'POST',
											'style'  => 'display: inline-block;'
										]) !!}
										{{ Form::hidden('task_id', $task_id) }}
										{{ Form::hidden('group_id', $group->group_id) }}
										{{ Form::submit('By one', ['class' => 'btn btn-primary']) }}
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
