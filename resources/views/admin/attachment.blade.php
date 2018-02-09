@extends('layouts.app')

@role('admin')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1><i class="fa fa-paperclip"></i> Mentor`s Attachments</h1>
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
								<th>Name</th>
								<th>Surname</th>
								<th>Patronymic</th>
								<th>E-mail</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->surname }}</td>
									<td>{{ $user->patronymic }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->role_name }}</td>
									<td>
										<a href="{{ route('admin.attachment.change', $user->id) }}"
										   class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="text-center">
				{!! $users->links() !!}
			</div>
		</div>
	</div>
@endsection
@endrole