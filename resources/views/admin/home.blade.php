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
					<table class="table table-bordered">
						<tr>
							<td>Total users count</td>
							<td>{{ $stats['users_count'] }}</td>
						</tr>
						<tr>
							<td>Total groups count</td>
							<td>{{ $stats['groups_count'] }}</td>
						</tr>
						<tr>
							<td>Total tasks count</td>
							<td>{{ $stats['tasks_count'] }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole
