@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Tasks panel</div>

				<div class="panel-body">
					<a href="{{ route('tasks.index') }}" class="btn btn-primary btn-block">My Tasks</a>
					<a href="{{ route('mentor.reports') }}" class="btn btn-primary btn-block">Check Reports</a>
					<a href="{{ route('mentor.finished') }}" class="btn btn-primary btn-block">Finished Reports</a>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Mentor Info</div>

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<th>Surname:</th>
									<td>{{ $data['mentor']->surname }}</td>
								</tr>
								<tr>
									<th>Name:</th>
									<td>{{ $data['mentor']->name }}</td>
								</tr>
								<tr>
									<th>Patronymic:</th>
									<td>{{ $data['mentor']->patronymic }}</td>
								</tr>
								<tr>
									<th>E-mail:</th>
									<td>{{ $data['mentor']->email }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
