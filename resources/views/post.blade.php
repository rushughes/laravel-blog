@extends('layouts.blog-post')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($post)
                          <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>
                              <img height="50" width="50" src="{{ $post->photo ? $post->photo->file : 'https://via.placeholder.com/50'}}" />
                            </td>
                            <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                            <td>{!! $post->body !!}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                          </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="card-header">{{ __('Leave a comment') }}</div>

                <div class="card-body">
                  {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

                    {!! Form::hidden('post_id', $post->id) !!}

                    <div class="form-group">
                      {!! Form::label('body', 'Body') !!}
                      {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Create Comment', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                    @include('layouts.errors')

                </div>

                @if($post->comments)
                    <div class="card-header">{{ __('Comments') }}</div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">Post Id</th>
                          <th scope="col">Is Active</th>
                          <th scope="col">Author</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Email</th>
                          <th scope="col">Body</th>
                          <th scope="col">Created</th>
                          <th scope="col">Updated</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($post->comments as $comment)
                          <tr>
                            <td>{{$comment->id}}</td>
                            <td><a href="{{ route('home.post', $comment->post->id) }}">{{$comment->post_id}}</a></td>
                            <td>{{$comment->is_active}}</td>
                            <td>{{$comment->author}}</td>
                            <td>
                              <img height="50" width="50" src="{{ $comment->photo ? $comment->photo : 'https://via.placeholder.com/50'}}" />
                            </td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->body}}</td>
                            <td>{{$comment->created_at->diffForHumans()}}</td>
                            <td>{{$comment->updated_at->diffForHumans()}}</td>
                            <td>
                              @if($comment->is_active == 1)
                                {!! Form::open(['method'=>'PUT',
                                  'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                  {!! Form::hidden('is_active', '0') !!}
                                  <div class="form-group">
                                    {!! Form::submit('Unapprove', ['class'=>'btn btn-primary']) !!}
                                  </div>
                                {!! Form::close() !!}

                                @else

                                {!! Form::open(['method'=>'PUT',
                                  'action'=>['PostCommentsController@update', $comment->id]]) !!}

                                  {!! Form::hidden('is_active', '1') !!}

                                  <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-primary']) !!}
                                  </div>

                                {!! Form::close() !!}
                              @endif
                              {!! Form::open(['method'=>'DELETE',
                                'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                <div class="form-group">
                                  {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                </div>

                              {!! Form::close() !!}
                            </td>
                          </tr>
                          <tr>
                            <td colspan="10">
                              @foreach($comment->replies as $reply)
                                {{$reply->author}}: {{$reply->body}}</p>
                              @endforeach
                            </td>
                          </tr>
                          <tr>
                            <td colspan="10">
                              {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                                {!! Form::hidden('comment_id', $comment->id) !!}

                                <div class="form-group">
                                  {!! Form::label('body', 'Body') !!}
                                  {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                  {!! Form::submit('Reply to comment', ['class'=>'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}

                                @include('layouts.errors')
                            </td>
                        @endforeach
                      </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
