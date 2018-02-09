@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-10">
			<h1><i class="fa fa-tasks"></i> Tasks</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tasks.create') }}" class="btn btn-success btn-block btn-h1-spacing"><i class="fa fa-plus"></i> New Task</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					@if($tasks->isEmpty())
					<p class="text-center">You don`t have any task yet!</p>
					@else
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach($tasks as $task)
								<tr>
									<td>{{ $task->id }}</td>
									<td>{{ $task->title }}</td>
									<td>
										{{ substr($task->description, 0, 50) }}
										{{ strlen($task->description) > 50 ? '...' : ''}}
									</td>
									<td>
										<a href="{{ route('tasks.show', $task->id) }}"
										   class="btn btn-primary"><i class="fa fa-edit"></i> Details</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					@endif
				</div>
			</div>

			<div class="text-center">
				{!! $tasks->links() !!}
			</div>
		</div>
	</div>
@endsection
@endrole
