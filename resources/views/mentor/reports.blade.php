@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Student Reports</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"><hr></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Surname</th>
									<th>Name</th>
									<th>Group</th>
									<th>Title</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tasks as $task)
								<tr>
									<td>{{ $task->id }}</td>
									<td>{{ $task->surname }}</td>
									<td>{{ $task->name }}</td>
									<td>{{ $task->short_title }}</td>
									<td>{{ $task->title }}</td>
									<td>
										<a href="{{ route('report.check', $task->id) }}">Check</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="text-center">
				{!! $tasks->links() !!}
			</div>
		</div>
	</div>
@endsection
@endrole