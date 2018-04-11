@extends('layouts.app')

@role('admin')
@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars" aria-hidden="true"></i> Control Panel</div>

				<div class="panel-body">
					<a href="{{ route('users.index') }}" class="btn btn-primary btn-block">Users Managing</a>
					<a href="{{ route('groups.index') }}" class="btn btn-primary btn-block">Groups Managing</a>
					<a href="{{ route('admin.attachment') }}" class="btn btn-primary btn-block">Group Attachment</a>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Stats</div>

				<div class="panel-body">
					<ul class="list-group">
						<li class="list-group-item">Total users count <span class="badge">{{ $stats['users_count'] }}</span></li>
						<li class="list-group-item">Total groups count <span class="badge">{{ $stats['groups_count'] }}</span></li>
						<li class="list-group-item">Total tasks count <span class="badge">{{ $stats['tasks_count'] }}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
