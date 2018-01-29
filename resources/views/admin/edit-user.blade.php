@extends('layouts.app')

@role('admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="well row">
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-primary btn-block">Save</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-danger btn-block">Delete</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($user) !!}

                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                        {{ Form::text('surname', null, ['class' => 'form-control']) }}
                        {{ Form::text('patronymic', null, ['class' => 'form-control']) }}
                        {{ Form::email('email', null, ['class' => 'form-control']) }}
                        {{ Form::text('roles[0] ', null, ['class' => 'form-control']) }}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endrole
