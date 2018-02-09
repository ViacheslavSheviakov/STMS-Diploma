@extends('layouts.app')

@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('tasks.index') }}" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> Tasks Editing</a>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New Task</div>

				<div class="panel-body">
					{!! Form::open(['route' => 'tasks.store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
					<div class="form-group">
						{{ Form::label('title', 'Title:', ['class' => 'control-label']) }}
						{{ Form::text('title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('desc', 'Description:', ['class' => 'control-label']) }}
						{{ Form::textarea('desc', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
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
