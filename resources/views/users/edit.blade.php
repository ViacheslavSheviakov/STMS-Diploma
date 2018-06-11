@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<a href="{{ route('users.show', $data['user']->id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
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
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Form::open(['route' => ['users.restore', $data['user']->id], 'method' => 'PUT']) !!}
						{!! Form::submit('Restore PSWD', ['class' => 'btn btn-primary btn-block']) !!}
						{!! Form::close() !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['users.destroy', $data['user']->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					{!! Form::model($data['user'], ['route' => ['users.update', $data['user']->id], 'method' => 'PATCH', 'data-parsley-validate' => '']) !!}

					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

					{{ Form::label('surname', 'Surname:') }}
					{{ Form::text('surname', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

					{{ Form::label('patronymic', 'Patronymic:') }}
					{{ Form::text('patronymic', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

					{{ Form::label('email', 'E-mail:') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

					{{ Form::label('a-groups', 'Groups:') }}
					{{ Form::select('a-groups', $data['groups'], $data['select'] , ['class' => 'form-control']) }}

					{{ Form::label('a-roles', 'Role:') }}
					{{ Form::select('a-roles', $data['roles'], '' , ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					
					{{ Form::label('t-token', 'Chat ID:') }}
					{{ Form::text('t-token', $data['user']->chat_id, ['class' => 'form-control']) }}
					<hr>
					{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
@endrole
