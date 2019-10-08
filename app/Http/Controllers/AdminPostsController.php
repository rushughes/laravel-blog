<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Category;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('photo_id')) {
          $name = time() . '-' . $file->getClientOriginalName();
          $path = $file->storeAs('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        $user->post()->create($input);
        return redirect()->route('posts.index');
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
      $post = Post::findOrFail($id);
      $categories = Category::pluck('name', 'id');
      return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $post = Post::FindOrFail($id);

      $input = $request->all();

      if ($file = $request->file('photo_id')) {
        $name = time() . '-' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $name);
        $photo = Photo::create(['file' => $name]);
        $input['photo_id'] = $photo->id;
      }

      Auth::user()->post()->whereId($id)->first()->update($input);

      return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);
      $photo = $post->photo;

      if ($photo) {
        if (unlink(public_path() . $post->photo->file)) {
          if ($photo->delete()) {
            if ($post->delete()) {
              Session::flash('message', 'Post was successfully deleted!');
            } else {
              Session::flash('message', 'Post was not deleted!');
            }
          } else {
            Session::flash('message', 'Unable to delete Post photo!');
          }
        } else {
          Session::flash('message', 'Unable to delete Post photo file!');
        }
      } else {
        if ($post->delete()) {
          Session::flash('message', 'Post was successfully deleted!');
        } else {
          Session::flash('message', 'Post was not deleted!');
        }
      }
      return redirect()->route('posts.index');
    }

    public function post($id) {
      $post = Post::findOrFail($id);
      return view('post', compact('post'));
    }
}
