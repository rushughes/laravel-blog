@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Categories</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($photos)
                        @foreach($photos as $photo)
                          <tr>
                            <td>{{$photo->id}}</td>
                            <td>
                              <img height="50" width="50" src="{{ $photo->file }}" />
                            </td>
                            <td>{{$photo->created_at->diffForHumans()}}</td>
                            <td>{{$photo->updated_at->diffForHumans()}}</td>
                            <td>
                              {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}

                                <div class="form-group">
                                  {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                </div>

                                {!! Form::close() !!}
                              </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
