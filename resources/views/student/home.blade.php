@extends('layouts.app')

@role('student')
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						Student
					</h4>
				</div>

				<div class="panel-body">
					<table class="table">
						<tbody>
							<tr>
								<th>Surname:</th>
								<td>{{ $user->surname }}</td>
							</tr>
							<tr>
								<th>Name:</th>
								<td>{{ $user->name }}</td>
							</tr>
							<tr>
								<th>Patronymic:</th>
								<td>{{ $user->patronymic }}</td>
							</tr>
							<tr>
								<th>E-mail:</th>
								<td>{{ $user->email }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						Tasks Stats
					</h4>
				</div>

				<div class="panel-body">
					<ul class="list-group">
						<li class="list-group-item">All <span class="badge">{{ $data['count'] }}</span></li>
						<li class="list-group-item">In Progress <span class="badge">{{ $data['in_progress'] }}</span></li>
						<li class="list-group-item">Checking <span class="badge">{{ $data['checking'] }}</span></li>
						<li class="list-group-item">Expired <span class="badge">{{ $data['expired'] }}</span></li>
						<li class="list-group-item">Completed <span class="badge">{{ $data['completed'] }}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h1>Tasks</h1>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					@if($tasks->isEmpty())
					<p>You have no tasks</p>
					@else
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>Title</th>
								<th>Description</th>
								<th>Deadline</th>
								<th>Action</th>
							</thead>
							<tbody>
								@foreach($tasks as $task)
								<tr class="
								@if($task->status == 1)
								default
								@elseif($task->status == 0)
								warning
								@elseif($task->status == 2)
								danger
								@elseif($task->status == 3)
								success
								@endif
								">
									<td>{{ $task->task->title }}</td>
									<td>
										{{ substr($task->task->description, 0, 100) }}
										{{ strlen($task->task->description) > 100 ? '...' : ''}}
									</td>
									<td>
										{{ $task->deadline_date }}
									</td>
									<td>
										{!! Form::open(['route' => 'student.task_info', 'method' => 'POST']) !!}
										{!! Form::hidden('tasklist_id', $task->id) !!}
										{!! Form::submit('Details', ['class' => 'btn btn-primary']) !!}
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="text-center">
			{!! $tasks->links() !!}
		</div>
	</div>
@endsection
@endrole
