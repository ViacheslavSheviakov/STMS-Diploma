@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('users.index') }}" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Users Editing</a>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New User</div>

				<div class="panel-body">
					{!! Form::open(['route' => 'users.store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
					<div class="form-group">
						{{ Form::label('u-name', 'Name:', ['class' => 'control-label']) }}
						{{ Form::text('u-name', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('u-surname', 'Surname:', ['class' => 'control-label']) }}
						{{ Form::text('u-surname', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('u-patronymic', 'Patronymic:', ['class' => 'control-label']) }}
						{{ Form::text('u-patronymic', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('u-email', 'E-mail:', ['class' => 'control-label']) }}
						{{ Form::email('u-email', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('u-group', 'Group:', ['class' => 'control-label']) }}
						{{ Form::select('u-group', $data['groups'], '', ['class' => 'form-control']) }}
					</div>
					<div class="form-group">
						{{ Form::label('u-type', 'Type:', ['class' => 'control-label']) }}
						{{ Form::select('u-type', $data['roles'], '', ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('t-token', 'Chat ID:') }}
						{{ Form::text('t-token', null, ['class' => 'form-control']) }}
					</div>
					{!! Form::submit('Create', ['class' => 'btn btn-success form-spacing-top']); !!}
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
