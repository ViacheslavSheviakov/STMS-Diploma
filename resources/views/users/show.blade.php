@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<a href="{{ route('users.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
				<hr>
				<table class="table table-bordered">
					<tr>
						<th>ID:</th>
						<td>{{ $data['user']->id }}</td>
					</tr>
					<tr>
						<th>Created At:</th>
						<td>{{ date('d.m.Y H:i', strtotime($data['user']->created_at)) }}</td>
					</tr>
					<tr>
						<th>Last Update:</th>
						<td>{{ date('d.m.Y H:i', strtotime($data['user']->updated_at)) }}</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<h2>User Data</h2>
					<table class="table table-bordered table-condensed table-hover">
						<tbody>
						<tr>
							<th>Name:</th>
							<td>{{ $data['user']->name }}</td>
						</tr>
						<tr>
							<th>Surname:</th>
							<td>{{ $data['user']->surname }}</td>
						</tr>
						<tr>
							<th>Patronymic:</th>
							<td>{{ $data['user']->patronymic }}</td>
						</tr>
						<tr>
							<th>Email:</th>
							<td>{{ $data['user']->email }}</td>
						</tr>
						@if($data['user']->group_id)
						<tr>
							<th>Group ID:</th>
							<td>{{ $data['user']->group_id }}</td>
						</tr>
						@endif
						<tr>
							<th>Role:</th>
							<td>{{ $data['role'] }}</td>
						</tr>
						</tbody>
					</table>
					<a href="{{ route('users.edit', $data['user']->id) }}" class="btn btn-primary">Edit</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
@endrole
