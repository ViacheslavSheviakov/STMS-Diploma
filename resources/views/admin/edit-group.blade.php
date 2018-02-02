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
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.groups.show') }}" class="btn btn-default btn-block"><i class="fa fa-angle-left"></i> Back</a>
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['admin.group.delete', $group->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($group, ['route' => ['admin.group.update', $group->id], 'method' => 'POST', 'data-parsley-validate' => '']) !!}

                        {{ Form::label('short_title', 'Short Title:') }}
                        {{ Form::text('short_title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}

                        {{ Form::label('full_title', 'Full Title:') }}
                        {{ Form::text('full_title', null, ['class' => 'form-control', 'data-parsley-required' => 'true']) }}
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
