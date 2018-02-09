@extends('layouts.app')

@role('mentor')
@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Tasks panel</div>

				<div class="panel-body">
					<a href="{{ route('tasks.index') }}" class="btn btn-primary btn-block">My Tasks</a>
					<a href="#" class="btn btn-primary btn-block">Check Reports</a>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Mentor</div>

				<div class="panel-body">
					<span style="color: #595; font-weight: bold;">OK!</span>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
