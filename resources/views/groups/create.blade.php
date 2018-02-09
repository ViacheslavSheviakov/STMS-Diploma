@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('groups.index') }}" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Groups Editing</a>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New Group</div>

				<div class="panel-body">
					{!! Form::open(['route' => 'groups.store', 'data-parsley-validate' => '']) !!}
					<div class="form-group">
						{{ Form::label('short-title', 'Short Title:', ['class' => 'control-label']) }}
						{{ Form::text('short-title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					</div>
					<div class="form-group">
						{{ Form::label('full-title', 'Full Title:', ['class' => 'control-label']) }}
						{{ Form::text('full-title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
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
