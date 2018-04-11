@extends('layouts.app')

@role('mentor')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Edit E-mail
				</div>
				<div class="panel-body">
					{!! Form::model($user, ['route' => 'auth.edit', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
					<div class="form-group">
						{!! Form::label('email', 'E-Mail:') !!}
						{!! Form::email('email', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) !!}
					</div>
					{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Edit Password
				</div>
				<div class="panel-body">
					{!! Form::open(['route' => 'auth.pswd.edit', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
					<div class="form-group">
						{!! Form::label('pass', 'Password:') !!}
						{!! Form::password('pass', ['class' => 'form-control', 'data-parsley-required' => 'true']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('pass_confirmation', 'Confirm Password:') !!}
						{!! Form::password('pass_confirmation', ['class' => 'form-control', 'data-parsley-required' => 'true', 'data-parsley-equalto' => '#pass']) !!}
					</div>
					{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
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