@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			 <a href="{{ route('groups.show', $group->group_id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
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
					<h2>Group Data</h2>
				</div>
				{!! Form::model($group, ['route' => ['groups.update', $group->group_id], 'method' => 'PATCH', 'data-parsley-validate' => '']) !!}
				<div class="panel-body">
					{{ Form::label('short_title', 'Short Title:') }}
					{{ Form::text('short_title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

					{{ Form::label('full_title', 'Full Title:') }}
					{{ Form::text('full_title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
				</div>
				<div class="panel-footer">
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
