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
                            <td>{{$post->body}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                          </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
