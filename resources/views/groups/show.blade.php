@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="{{ route('groups.index', $group->group_id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
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
				<div class="panel-body">
					<table class="table table-bordered table-condensed table-hover">
						<tbody>
						<tr>
							<th>Short Title:</th>
							<td>{{ $group->short_title }}</td>
						</tr>
						<tr>
							<th>Full Title:</th>
							<td>{{ $group->full_title }}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<a href="{{ route('groups.edit', $group->group_id) }}" class="btn btn-primary"> Edit</a>
					{!! Form::open(['route' => ['groups.destroy', $group->group_id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) !!}
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
@endrole
