@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                  {!! Form::model($user, ['method'=>'POST',
                    'action'=>['AdminUsersController@store',$user->id],
                    'files'=>'true']) !!}

                    <div class="form-group">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('email', 'Email') !!}
                      {!! Form::text('email', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('is_active', 'Active') !!}
                      {!! Form::select('is_active', ['1' => 'Enabled', '0' => 'Disabled'], 'Enabled', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('role_id', 'Role') !!}
                      {!! Form::select('role_id', $roles, '2', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                      <img height="50" width="50" src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/50'}}" />
                      {!! Form::label('photo_id', 'Photo') !!}
                      {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('password', 'Password') !!}
                      {!! Form::password('password', ['class' => 'form-control']); !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Update User', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
