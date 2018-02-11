@extends('layouts.app')

@role('admin')
@section('content')
	<div class="row">
		<div class="col-md-10">
			<h1><i class="fa fa-users" aria-hidden="true"></i> Groups Editing</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('groups.create') }}" class="btn btn-success btn-block btn-h1-spacing"><i class="fa fa-plus-square"></i> Create New</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>ID</th>
								<th>Short Title</th>
								<th>Full Title</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach($groups as $group)
								<tr>
									<td>{{ $group->group_id }}</td>
									<td>{{ $group->short_title }}</td>
									<td>{{ $group->full_title }}</td>
									<td>
										<a href="{{ route('groups.show', $group->group_id) }}"
										   class="btn btn-primary"><i class="fa fa-edit"></i> Details</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="text-center">
				{!! $groups->links() !!}
			</div>
		</div>
	</div>
@endsection
@endrole
