@extends('layouts.app')

@role('admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><i class="fa fa-users" aria-hidden="true"></i> Users Editing</h1>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.user.new') }}" class="btn btn-success btn-block btn-h1-spacing">Create New</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Patronymic</th>
                                    <th>E-mail</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->patronymic }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles()->pluck('name')[0] }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@endrole
