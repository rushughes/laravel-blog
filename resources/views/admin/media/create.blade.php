@extends('layouts.app')

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Photo') }}</div>

                <div class="card-body">
                  {!! Form::open(['method'=>'POST',
                    'action'=>'AdminMediaController@store',
                    'class'=>'dropzone']) !!}

                    {!! Form::close() !!}

                    @include('layouts.errors')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection
