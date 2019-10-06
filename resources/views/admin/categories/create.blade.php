@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Category') }}</div>

                <div class="card-body">
                  {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

                    <div class="form-group">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
