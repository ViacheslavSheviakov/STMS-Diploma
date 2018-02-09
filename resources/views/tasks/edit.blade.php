@extends('layouts.app')


@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('tasks.show', $task->id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'PATCH', 'data-parsley-validate' => '']) !!}
			<div class="panel panel-default">

				<div class="panel-heading">
					{{ Form::text('title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
				</div>
				<div class="panel-body">
					{{ Form::textarea('description', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
				</div>
				<div class="panel-footer">
					{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
