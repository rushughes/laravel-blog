@extends('layouts.app')

@section('content')

  @include('layouts.tinyeditor')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">
                  {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>'true']) !!}

                    <div class="form-group">
                      {!! Form::label('title', 'Title') !!}
                      {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('body', 'Body') !!}
                      {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('category_id', 'Category') !!}
                      {!! Form::select('category_id', $categories, '0', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('photo_id', 'Photo') !!}
                      {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
