@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                  {!! Form::model($category, ['method'=>'PUT',
                    'action'=>['AdminCategoriesController@update',$category->id],
                    ]) !!}

                    <div class="form-group">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Update Category', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    {!! Form::open(['method'=>'DELETE',
                      'action'=>['AdminCategoriesController@destroy',
                      $category->id]]) !!}

                      <div class="form-group">
                        {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
                      </div>

                      {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
