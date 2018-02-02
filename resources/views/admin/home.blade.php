@extends('layouts.app')

@role('admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-bars" aria-hidden="true"></i> Control Panel</div>

                    <div class="panel-body">
                        <a href="{{ route('admin.users.show') }}" class="btn btn-primary btn-block">Users Managing</a>
                        <a href="{{ route('admin.groups.show') }}" class="btn btn-primary btn-block">Groups Managing</a>
                        <a href="#" class="btn btn-primary btn-block">View Tasks</a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
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
    </div>
@endsection
@endrole
