@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Post') }}</div>

                <div class="card-body">
                  {!! Form::model($post, ['method'=>'PUT',
                    'action'=>['AdminPostsController@update', $post->id],
                    'files'=>'true']) !!}

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
                      {!! Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                      <img height="50" width="50" src="{{ $post->photo ? $post->photo->file : 'https://via.placeholder.com/50'}}" />
                      {!! Form::label('photo_id', 'Photo') !!}
                      {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

                      <div class="form-group">
                        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
                      </div>

                      {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
