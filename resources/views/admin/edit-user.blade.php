@extends('layouts.app')

@role('admin')
@section('styles')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="well">
                    <a href="{{ route('admin.users.show') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Back</a>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID:</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ date('d.m.Y H:i', strtotime($user->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Last Update:</th>
                            <td>{{ date('d.m.Y H:i', strtotime($user->updated_at)) }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.user.pass.restore', $user->id) }}" class="btn btn-primary btn-block">Restore PSWD</a>
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['admin.user.delete', $user->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'POST', 'data-parsley-validate' => '']) !!}

                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

                        {{ Form::label('surname', 'Surname:') }}
                        {{ Form::text('surname', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

                        {{ Form::label('patronymic', 'Patronymic:') }}
                        {{ Form::text('patronymic', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

                        {{ Form::label('email', 'E-mail:') }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

                        {{ Form::label('a-roles', 'Role:') }}
                        {{ Form::select('a-roles', $roles->pluck('name', 'id'), '' , ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
                        <hr>
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@endsection
@endrole
