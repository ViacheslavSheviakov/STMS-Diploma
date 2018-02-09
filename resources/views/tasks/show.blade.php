@extends('layouts.app')


@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('tasks.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>{{ $task->title }}</h2>
				</div>
				<div class="panel-body">
					<p class="text-justify">
						{{ $task->description }}
					</p>
				</div>
				<div class="panel-footer">
					<a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary"> Edit</a>
					{!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
