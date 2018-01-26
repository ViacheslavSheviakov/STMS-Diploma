@extends('layouts.app')

@role('admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <a href="{{ route('admin.user.new') }}" class="btn btn-primary btn-block">New User</a>
                        <a href="#" class="btn btn-primary btn-block">Delete</a>
                        <a href="#" class="btn btn-primary btn-block">Edit</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Groups</div>

                    <div class="panel-body">
                        <a href="#" class="btn btn-primary btn-block">Create</a>
                        <a href="#" class="btn btn-primary btn-block">Delete</a>
                        <a href="#" class="btn btn-primary btn-block">Edit</a>
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
    </div>
@endsection
@endrole
