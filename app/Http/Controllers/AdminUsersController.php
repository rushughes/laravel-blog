<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);

        if ($file = $request->file('photo_id')) {
          $name = time() . '-' . $file->getClientOriginalName();
          $path = $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        User::create($input);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->toArray();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateRequest $request, $id)
    {
        $user = User::FindOrFail($id);

        if ($request->get('password') == '') {
          $input = $request->except('password');
        } else {
          $input = $request->all();
        }

        if ($file = $request->file('photo_id')) {
          $name = time() . '-' . $file->getClientOriginalName();
          $path = $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
