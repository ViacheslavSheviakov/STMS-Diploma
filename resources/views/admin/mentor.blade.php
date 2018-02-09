@extends('layouts.app')

@role('admin')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('admin.attachment') }}" class="btn btn-default">
				<i class="fa fa-angle-left"></i> Back
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	<div class="row">
		@if (!$data['select']->isEmpty())
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Attach Form
				</div>
				<div class="panel-body">
					{!! Form::open(['route' => ['admin.attachment.store', $data['id']], 'method' => 'POST', 'data-parsley-validate' => '']) !!}
					{{ Form::label('groups', 'Groups:')}}
					{{ Form::select('groups', $data['select'], '', ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
					<hr>
					{{ Form::submit('Attach', ['class' => 'btn btn-success'])}}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
		@endif

		@if (!$data['select']->isEmpty())
		<div class="col-md-8">
		@else
		<div class="col-md-12">
		@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					Attached Groups
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Short Title</th>
								<th>Full Title</th>
								<th>Actions</th>
							</tr> 
						</thead>
						<tbody>
							@foreach($data['groups'] as $group)
							<tr>
								<td>{{ $group->short_title }}</td>
								<td>{{ $group->full_title }}</td>
								<td>
									{!! Form::open(['route' => ['admin.attachment.remove', $data['id']], 'method' => 'POST']) !!}
									{{ Form::hidden('group', $group->id)}}
									{{ Form::button('<i class="fa fa-minus"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'])}}
									{!! Form::close() !!}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
@endrole