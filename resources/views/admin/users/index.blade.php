@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Users</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Active</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(@users)
                      @foreach($users as $user)
                        <tr>
                          <td>{{$user->id}}</td>
                          <td>
                            <img height="50" width="50" src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/50'}}" />
                          </td>
                          <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->role->name}}</td>
                          <td>{{$user->is_active ? 'Enabled' : 'Disabled'}}</td>
                          <td>{{$user->created_at->diffForHumans()}}</td>
                          <td>{{$user->updated_at->diffForHumans()}}</td>
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
