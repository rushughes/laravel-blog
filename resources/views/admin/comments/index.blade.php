@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comments</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Post Id</th>
                        <th scope="col">Is Active</th>
                        <th scope="col">Author</th>
                        <th scope="col">Email</th>
                        <th scope="col">Body</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($posts)
                        @foreach($comments as $comment)
                          <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->post_id}}</td>
                            <td>{{$comment->is_active}}</td>
                            <td>{{$comment->author}}</td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->body}}</td>
                            <td>{{$comment->created_at->diffForHumans()}}</td>
                            <td>{{$comment->updated_at->diffForHumans()}}</td>
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
