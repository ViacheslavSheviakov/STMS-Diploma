@extends('layouts.app')


@section('styles')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/alertify.min.css') !!}
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
					<a href="{{ route('mentor.attach', $task->id) }}" class="btn btn-primary">Give</a>
					{!! Form::open([
						'id'     => 'task-form',
						'route'  => ['tasks.destroy', $task->id],
						'method' => 'DELETE',
						'style'  => 'display: inline-block;'
					]) !!}
					{!! Form::button('Delete', ['id' => 'btn-submit', 'class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/alertify.min.js') !!}
	<script>
		alertify.dialog('confiramtion',function factory(){
		    return{
		            build:function(){
		                var errorHeader = 'Confirmation';
		                this.setHeader(errorHeader);
		            }
		        };
		    },true,'confirm');

		$("#btn-submit").on("click", function(event) {
			event.preventDefault();
			alertify.confiramtion("Do you really wat to delete this task?", function(e) {
				if (e) {
					$("#task-form").submit();
					return true;
				} else {
					return false;
				}
			});
		});
	</script>
@endsection
